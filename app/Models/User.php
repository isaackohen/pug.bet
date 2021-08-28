<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Lab404\Impersonate\Models\Impersonate;
use Laravel\Sanctum\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use MongoDB\BSON\Decimal128;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $connection = 'mongodb';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usd',
        'bonus',
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


    public function getBalance(Request $request)
    {
        $playerId = $request['playerid'];
        $currency = $request['currency'];
        $user = \App\Models\User::where('_id', $playerId)->first();
                $balancenumber = number_format($user->usd * 100, 0, '.', '');

                return response()->json([
                    'status' => 'ok',
                    'result' => ([
                        'balance' => $balancenumber,
                        'freegames' => 0
                    ])
                ]);

    }


    public function bet(Request $request)
     {
        $playerId = $request['playerid'];
        $currency = $request['currency'];
        $user = \App\Models\User::where('_id', $playerId)->first();
        $gameid = $request['gameid'];
        $bet = $request['bet'];
        $win = $request['win'];
        $roundid = $request['roundid'];
        $final = $request['final'];

        $gamestatus = 'game';      
        if($final === '1') {
            $gamestatus = 'game_final';
        }

        if($bet > 0 ){
            $user->subtract(round($bet / 100, 2), 'usd', $gamestatus, array("game" => $gameid, "round" => $roundid));
        }

        if($win > 0) {
            $user->add(round($win / 100, 2), 'usd', $gamestatus, array("game" => $gameid, "round" => $roundid));
        }

        if($final === '1') {
        $getwager = BalanceLog::where('internal', '=', $roundid)->where('subtract', '>', '0')->first() ?? 0;
        $getwager = $getwager['subtract'];
        GameHistory::create([
            'u' => $playerId,
            'win' => $win,
            'bet' => $getwager,
            'gameid' => $gameid,
            'curr' => $currency,
            'meta' => null
        ]);
        }

        return response()->json([
            'status' => 'ok',
            'result' => ([
                'balance' => number_format($user->balance() * 100, 0, '.', ''),
                'freegames' => 0
            ])
        ]);
    }


    public function add(float $amount, $type, $reason, array $data = null) {
        $balance = $this->balance();
        $this->update([
            $type => floatval(number_format($balance + $amount, 2, '.', ''))
        ]);      

        //event(new BalanceModification($this->user, $type, 'subtract', $amount, 0));
        BalanceLog::create([
            'u' => $this->_id,
            'add' => $amount,
            'subtract' => '0',
            'bal' => $this->balance(),
            'curr' => $type,
            'meta' => $reason,
            'data' => $data ?? []
        ]);

    }

    public function subtract(float $amount, $type, $reason, array $data = null) {
        $balance = $this->balance();
        $value = $this->balance() - $amount;
        if($value < 0) $value = 0;
        $this->update([
            $type => floatval(number_format($value, 2, '.', ''))
        ]);
        //event(new BalanceModification($this->user, $type, 'subtract', $amount, 0));
        BalanceLog::create([
            'u' => $this->_id,
            'add' => 0,
            'subtract' => $amount,
            'bal' => $this->balance(),
            'curr' => $type,
            'meta' => $reason,
            'data' => $data ?? []
        ]);


    }

    public function balance(): float {
        $value = floatval($this->usd);
        return number_format($value, 2, '.', '');
    }
}
