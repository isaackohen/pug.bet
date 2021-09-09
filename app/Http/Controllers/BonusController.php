<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\BalanceLog;
use App\Models\GameHistory;
use App\Http\Livewire\Component;
use App\Http\Livewire\Latestgames;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
class BonusController extends Controller
{

     public function defaultseedViplevelsForeach($level, $level_name, $icon, $start, $end, $rake_percent, $promo, $faucet, $fsbonus, $jackpotbonus) {

            \App\Models\VIP\VipLevels::create([
            'level' => $level,
            'level_name' => $level_name,
            'icon' => $icon,
            'start' => $start,
            'end' => $end,
            'rake_percent' => $rake_percent,
            'promocode_bonus' => $promo,
            'faucet_bonus' => $faucet,
            'fs_bonus' => $fsbonus,
            'jackpot_bonus' => $jackpotbonus        ]);

}
     public function defaultseedViplevels() {

    self::defaultseedViplevelsForeach(1, "VIP 1", "299.99", "999.99", "0.002", "1.5", "5", "6", "0.02");
    self::defaultseedViplevelsForeach(2, "VIP 2", "1000.00", "1999.99", "0.006", "2", "10", "12", "0.03");
    self::defaultseedViplevelsForeach(3, "VIP 3", "2000.00", "3999.99", "0.007", "2.5", "15", "12", "0.04");
    self::defaultseedViplevelsForeach(4, "VIP 4", "1000", "1999.99", "0.008", "3", "20", "12", "0.05");
    self::defaultseedViplevelsForeach(5, "VIP 5", "1000", "1999.99", "0.009", "3.5", "25", "15", "0.06");
    self::defaultseedViplevelsForeach(6, "VIP 6", "1000", "1999.99", "0.010", "4", "30", "20", "0.07");
    self::defaultseedViplevelsForeach(7, "VIP 7", "1000", "1999.99", "0.011", "4.5", "35", "25", "0.08");
    self::defaultseedViplevelsForeach(8, "VIP 8", "1000", "1999.99", "0.012", "5", "40", "25", "0.09");
    self::defaultseedViplevelsForeach(9, "VIP 9", "1000", "1999.99", "0.013", "5.5", "45", "30", "0.1");
    self::defaultseedViplevelsForeach(10, "VIP 10", "1000", "1999.99", "0.014", "6", "50", "35", "0.12");


    return 'ok';
              
}


}
