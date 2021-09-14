<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use WireUi\Traits\Actions;

class UserController extends Controller
{
        use Actions;

        public static function processGame($playerId, $wager, $win, $gameid) {
         $user = \App\Models\User::where('_id', $playerId)->first();
         $stats = \App\Models\UserStatistics::where('u', $playerId)->first();
         $multiplier = 0;
         if($win > 0 && $wager > 0){
            $multiplier = round(($win / $wager), 2) ?? 0;
         }

         if(!$stats) {
           \App\Models\UserStatistics::create([
                'u' => $playerId,
                'usd_games' => 0,
                'usd_wager' => 0,
                'usd_win' => 0,
                'vip_wager' => 0,
                'vip_wager_tot' => 0,
                'biggest' => 0,
                'luckiest' => 0,
                'biggest_game' => 0,
                'luckiest_game' => 0,
            ]);
           return;
         }

         //Check for multiplier and execute VIP level and bonus processing 
        if($multiplier > 1.11 or $multiplier < 0.95) {
            \App\Models\Jackpot::verify($gameid, $wager, $playerId);

            $vipModifier = 1;

            //Add VIP progression
            $stats->update([
                'vip_wager' => round($stats->vip_wager ?? 0, 2) + round(($wager * $vipModifier), 2),
                'vip_wager_tot' => round($stats->vip_wager_tot ?? 0, 2) + round(($wager * $vipModifier), 2),
            ]);

            $getcurrentViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel))->first();
            $getViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel + 1))->first();
            $getFs = $getViplevels->fs_bonus;

            //Check if next VIP wager requirement is reached, then change VIP level
            if($user->progressVip($user->_id) > $getViplevels->start) {
                \App\Models\UserStatistics::where('u', $user->_id)->update([
                'vip_wager' => 0
            ]);


            //Add free spins if level up
            $user->update([
                'viplevel' => $user->viplevel + 1,
                'freespins' => ($user->freespins ?? 0) + ($getFs)
            ]);   

            event(new \App\Events\PlaySound($user, "/sounds/coins.mp3"));
            event(new \App\Events\UserNotification($user, "VIP Level Increased", "You have advanced to VIP Level ".$user->viplevel, "success"));
            event(new \App\Events\UserNotification($user, "VIP Gift", "You have received ".$getFs." free spins!", "success"));


        }}

        $getcurrentViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel))->first();

        //Get rake percentage from VIP and add to account
        $getRake = ($wager * $getcurrentViplevels->rake_percent);
        \App\Models\User::where('_id', $user->_id)->update([
            'rake' => round(($user->rake ?? 0) + ($getRake ?? 0), 2)
        ]);   

        //Update user stats
        $stats->update([
            'usd_games' => $stats->usd_games + 1,   
            'usd_wager' => round($stats->usd_wager + ($wager ?? 0), 2),
            'usd_win' => round($stats->usd_win + ($win ?? 0), 2),
        ]);
        
        //Check and add win highscore to user
        if($win > $stats->biggest) {
            $stats->update([
                'biggest' => $win,
                'biggest_game' => $gameid,
            ]);
        }

        //Check and add multiplier highscore to user
        if($multiplier > $stats->luckiest) {
            $stats->update([
                'luckiest' => $multiplier,
                'luckiest_game' => $gameid,
            ]);
        }
        }
}
