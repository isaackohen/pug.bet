<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Settings;
use App\Models\User;
use App\Models\UserStatistics;
use Illuminate\Support\Facades\Cache;

class Jackpot extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'jackpot_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'jackpot_usd', 'currency', 'jackpot_currency', 'game', 'wager_usd'
    ];
    

    public static function jackpotAmount() {
        $jackpot_amount = Cache::get('jackpot_amount');     
        if (!$jackpot_amount) { $jackpot_amount = \App\Models\Settings::where('key', 'jackpot_sum')->first()->value;
            Cache::put('jackpot_amount', $jackpot_amount, Carbon::now()->addSeconds(20));
        } return number_format($jackpot_amount, 2, ".", "");
    }

    public static function verify($game_id, $usd_wager, $userid) {
            $jackpotMin = Settings::where('key', 'jackpot_min')->first()->value;
            
            if ($usd_wager > $jackpotMin) {
                $user = User::where('_id', $userid)->first();

                $percentGameJackpot = Settings::where('key', 'jackpot_chance')->first()->value;
                $jackpotSum = Settings::where('key', 'jackpot_sum')->first()->value;
                $jackpotContribution = Settings::where('key', 'jackpot_contribution')->first()->value;

                $jackpot_usd = ($usd_wager / 100) * $jackpotContribution;

                $newjackpot = $jackpotSum + $jackpot_usd;
                Settings::where('key', 'jackpot_sum')->update(['value' => $newjackpot]);
                $chance = mt_rand(0, 10000);
                
                $vipchance = 0;
                if($user->viplevel > 0){
                    $getcurrentViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel))->first();
                    $vipchance = $getcurrentViplevels->jackpot_bonus;
                }
                $basePercentChance = $percentGameJackpot + $vipchance;
                $wagerChance = $usd_wager;
                
                if($usd_wager > 5) {
                    $wagerChance = 5;
                }

                $finalPercentChance = $basePercentChance * $wagerChance;
                
                $jackpot_win_chance = ($finalPercentChance * 100);
                
                if($chance < $jackpot_win_chance) {
                Log::info('Jackpot Game: '.$game_id.' | Jackpot RNG generated: '.$chance.' | Jackpot RNG User: '.$jackpot_win_chance.' | Base Chance '.$basePercentChance.' | Wager Multiplier '.$wagerChance.' | Jackpot status: win!');
                }
                if($chance > $jackpot_win_chance) {
                //Log::info('Jackpot Game: '.$game_id.' | Jackpot RNG generated: '.$chance.' | Jackpot RNG User: '.$jackpot_win_chance.' | Base Chance '.$basePercentChance.' | Wager Multiplier '.$wagerChance.' | Jackpot status: lose!');
                }
                              
                if($chance < $jackpot_win_chance) {
                    //$user->balance(Currency::find($jackpotCurrency))->add($cryptoamount, \App\Transaction::builder()->message('Jackpot Win')->get());
                    $user->add(
                        number_format($newjackpot, 2, ".", ""),
                        "usd",
                        "jackpot",
                        json_encode(["jackpot_usd" => number_format($newjackpot, 2, ".", ""), "baseChance" => $basePercentChance, "RNGnumberSystem" => $chance, "RNGnumberUser" => $jackpot_win_chance, "wager_usd" => $usd_wager])
                    ); 
                    $jackpotBase = Settings::where('key', 'jackpot_base')->first()->value;
                    Settings::where('key', 'jackpot_sum')->update(['value' => $jackpotBase]);
                    event(new \App\Events\PublicNotification("Jackpot Winner", "Jackpot has been won by ".$user->name." for ".$newjackpot."$!", "success", "/sounds/coins.mp3"));

                    Log::info('New jackpot winner! User: '.$user->_id);
                    Jackpot::create([
                        'user' => $user->_id, 
                        'jackpot_usd' => number_format($newjackpot, 2, ".", ""),
                        'jackpot_currency' => 'USD',
                        'game' => $game_id, 
                        'wager_usd' => $usd_wager
                    ]);
                    
                }
            }
        }
}
