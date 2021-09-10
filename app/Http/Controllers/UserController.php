<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

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

         if($multiplier > 1.15 || $multiplier < 0.95) {
            $vipModifier = 0.95;
            $stats->update([
                'vip_wager' => round($stats->vip_wager ?? 0, 2) + round(($wager * $vipModifier), 2),
                'vip_wager_tot' => round($stats->vip_wager_tot ?? 0, 2) + round(($wager * $vipModifier), 2),
            ]);

            $getcurrentViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel))->first();
            $getViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel + 1))->first();


            if($user->progressVip($user->_id) > $getViplevels->start) {
                \App\Models\UserStatistics::where('u', $user->_id)->update([
                'vip_wager' => 0
            ]);

            $getFs = $getViplevels->fs_bonus;

            \App\Models\User::where('_id', $user->_id)->update([
                'viplevel' => $user->viplevel + 1,
                'freespins' => ($user->freespins ?? 0) + ($getFs ?? 0)
            ]);   
            }}
            $getcurrentViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel))->first();

            $getRake = ($wager * $getcurrentViplevels->rake_percent);
            \App\Models\User::where('_id', $user->_id)->update([
                'rake' => round(($user->rake ?? 0) + ($getRake ?? 0), 2)
            ]);   




        $stats->update([
            'usd_games' => $stats->usd_games + 1,   
            'usd_wager' => round($stats->usd_wager + ($wager ?? 0), 2),
            'usd_win' => round($stats->usd_win + ($win ?? 0), 2),
        ]);
         if($win > $stats->biggest) {
            $stats->update([
                'biggest' => $win,
                'biggest_game' => $gameid,
            ]);
         }

         if($multiplier > $stats->luckiest) {
            $stats->update([
                'luckiest' => $multiplier,
                'luckiest_game' => $gameid,
            ]);
         }



        }



}
