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
         if($wager > 0 and $win > 0){
         $multiplier = round(($win / $wager), 2) ?? 0;
         }

         if(!$stats) {
           \App\Models\UserStatistics::create([
                'u' => $playerId,
                'usd_games' => 0,
                'usd_wager' => 0,
                'usd_win' => 0,
                'vip_wager' => 0,
                'biggest' => 0,
                'luckiest' => 0,
                'biggest_game' => 0,
                'luckiest_game' => 0,
            ]);
           return;
         }

         if($multiplier > 1.20 || $multiplier < 0.92) {
            $stats->update([
                'vip_wager' => round($stats->vip_wager ?? 0, 2) + round($wager, 2),
            ]);

         }
         if($win > $stats->biggest) {
            $stats->update([
                'biggest' => $win,
                'biggest_game' => $gameid,
            ]);
         }

         if($wager > 0 and $win > 0) {
         if(($win / $wager) > $stats->luckiest) {
            $stats->update([
                'luckiest' => $multiplier,
                'luckiest_game' => $gameid,
            ]);
         } }

            $stats->update([
                'usd_games' => $stats->usd_games + 1,
                'usd_wager' => round($stats->usd_wager + ($wager ?? 0), 2),
                'usd_win' => round($stats->usd_win + ($win ?? 0), 2),
            ]);

        }



}
