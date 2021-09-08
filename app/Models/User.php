<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Events\BalanceModification;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\Decimal128;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maklad\Permission\Traits\HasRoles;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $connection = 'mongodb';
    public $guard_name = 'sanctum';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'token',
        'usd',
        'bonus',
        'deposited',
        'withdrawn',
        'arcade',
        'poker'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function add(float $amount, $type, $reason, $internal = null, array $data = null) {
        $decode = json_decode($internal, true);
        $balance = $this->balance();
        $this->update([
            $type => floatval(number_format($balance + $amount, 2, '.', ''))
        ]);      

        event(new BalanceModification($this, 'usd', $type, 'subtract', $amount, 0));
        BalanceLog::create([
            'u' => $this->_id,
            'add' => $amount,
            'subtract' => '0',
            'bal' => $this->balance(),
            'curr' => $type,
            'meta' => $reason,
            'internal' => $decode['round'] ?? 0,
            'data' => $internal ?? []
        ]);

    }

    public function subtract(float $amount, $type, $reason, $internal = null, array $data = null) {
        $balance = $this->balance();
        $value = $this->balance() - $amount;
        $decode = json_decode($internal, true);
        if($value < 0) $value = 0;
        $this->update([
            $type => floatval(number_format($value, 2, '.', ''))
        ]);
        event(new BalanceModification($this, 'usd', $type, 'subtract', $amount, 0));
        BalanceLog::create([
            'u' => $this->_id,
            'add' => 0,
            'subtract' => $amount,
            'bal' => $this->balance(),
            'curr' => $type,
            'meta' => $reason,
            'internal' => $decode['round'] ?? 0,
            'data' => $internal ?? []
        ]);


    } 

    public static function findUsername($id) {
        $user = \App\Models\User::where('_id', $id)->first();

        return $user->name;
    }

    public function balance(): float {
        $value = floatval($this->usd);
        return number_format($value, 2, '.', '');
    }
}
