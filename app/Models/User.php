<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
use Illuminate\Support\Facades\Cache;
 use Carbon\Carbon;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use CrudTrait;
    protected $connection = 'mongodb';
    public $guard_name = 'sanctum';

public function openGoogle($crud = false)
{
    return '<a class="btn btn-sm btn-link" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="fa fa-search"></i> Google it</a>';
}
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
        'rake',
        'freespins',
        'is_admin',
        'withdrawn',
        'arcade',
        'poker',
        'viplevel'
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

    public static function progressVip($id) {
        $user = \App\Models\UserStatistics::where('u', $id)->first();

        return $user->vip_wager ?? 0;
    }

    public function vipPercent() {
            $getViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($this->viplevel + 1))->first();
        $concatVip = 'getViplevels'.$this->viplevel;
        $concatVip = Cache::get($concatVip);     
        if (!$concatVip) { $concatVip = \App\Models\VIP\VipLevels::where('level', '=', ($this->viplevel + 1))->first();
            Cache::put($concatVip, $concatVip, Carbon::now()->addMinutes(15));



            $vippercentfunc = round(($this->progressVip($this->_id) / $concatVip->start) * 100, 2) ?? 0;

    return number_format($vippercentfunc, 0, '.', ''); 
    }
}
    
    public function balance(): float {
        $value = floatval($this->usd);
        return number_format($value, 2, '.', '');
    }
}
