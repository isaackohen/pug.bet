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
class GameController extends Controller
{

     public function defaultseedViplevelsForeach($level, $level_name, $start, $end, $rake_percent, $promo, $faucet, $fsbonus, $jackpotbonus) {

            \App\Models\Viplevels::create([
            'level' => $level,
            'level_name' => $level_name,
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


    public function slotsPage()
    {
        $slots = DB::table('slotslist')->where('p', '!=', 'playstar')->where('d', '!=', '1')->where('p', '!=', 'upgames')->simplePaginate(60);

        return view('slots/slotslist', compact('slots'));
    }



    public function providerPage($provider)
    {
        $slots = DB::table('slotslist')->where('p', '=', $provider)->simplePaginate(60);

        return view('slots/slotslist', compact('slots'));
    }

    public function livecasinoPage()
    {
        $slotslist = DB::table('slotslist')->where('type', '=', 'live')->where('d', '!=', '1')->where('p', '!=', 'upgames')->get();
        return view('livewire.livecasino', ['slots' => $slotslist]);
    }

    // Start slots game //
    public function slotsgame($game)
    {
     
        $currency = 'usd';
        $game = DB::table('slotslist')->where('_id', '=', $game)->first();

        if($game['type'] === 'live' && $game['p'] !== 'upgames') { return redirect('/slots/real/live/'.$game['_id']);};

        //if(auth()->user()->balance() === '0') { redirect('slots.demo');};
            $playerid = auth()->user()->_id;
            $apigamble_apikey = \App\Http\Controllers\Controller::operatorkey();

        $construct = "https://api.bulk.bet/v2/createSession?apikey=".$apigamble_apikey."&userid=".$playerid."-".$currency."&game=".$game['_id'];
       
        $response = json_decode(file_get_contents($construct), true);
        $url = $response['url'];

        $slotslist = DB::table('slotslist')->get();
        $filter = $slotslist->where('_id', '=', $slotslist)->first();

        return view('slots/play')->with('id_game', $game)->with('name_game', $filter)->with('url', $url);

    }
    // Start live game //
    public function livegame($game)
    {
        $currency = 'usd';
        $game = DB::table('slotslist')->where('_id', '=', $game)->first();
            $apigamble_apikey = \App\Http\Controllers\Controller::operatorkey();

        $subgame = $game['u_id'];
        $provider = $game['p'];
        $playerid = auth()->user()->_id;
        $playername = auth()->user()->name;
        $category = null;
        if($game['_id'] === 'evo_blackjack_lobby'){
            $category = '&category=blackjack';
        }
        if($game['_id'] === 'evo_roulette_lobby'){
            $category = '&category=roulette';
        }
        if($game['_id'] === 'evo_baccarat_lobby'){
            $category = '&category=baccarat';
        }

        $construct = "https://api.bulk.bet/v2/createSession?apikey=".$apigamble_apikey."&userid=".$playerid."-".$currency."&game=".$game['_id'];

        //$construct = 'http://slots.apigamble.com/api/callback/riselive?provider='.$provider.'&subgame='.$subgame.'&name='.$playername.'&userid='.$playerid.'-usd&operator=201';
        $response = Http::get($construct);
        $url = $response['url'];


        return view('slots/play')->with('id_game', $provider)->with('name_game', 'livegame')->with('url', $url);     
    }

    // Callbacks //

    public function pokerCallback(Request $request)
    {
        Log::notice($request);
    }

    public function getBalance(Request $request)
    {
        $playerId = $request["playerid"];
        $currency = $request["currency"];
        $user = \App\Models\User::where("_id", $playerId)->first();
        $balancenumber = number_format($user->usd * 100, 0, ".", "");

        return response()->json([
            "status" => "ok",
            "result" => [
                "balance" => $balancenumber,
                "freegames" => 0,
            ],
        ]);
    }


    public function bet(Request $request)
    {
        $playerId = $request["playerid"];
        $currency = $request["currency"];
        $user = \App\Models\User::where("_id", $playerId)->first();
        $gameid = $request["gameid"];
        $bet = $request["bet"];
        $win = $request["win"];
        $roundid = $request["roundid"];
        $final = $request["final"];
        $bonusmode = $request["bonusmode"] ?? 0;

        $gamestatus = "game";
        if ($final === "1") {
            $gamestatus = "game_final";
        }

        if ($bet > 0) {
            if (round($bet / 100, 2) > $user->balance()) {
                return response()->json([
                    "status" => "error",
                    "error" => [
                        "scope" => "user",
                        "no_refund" => "1",
                        "message" => "Not enough money",
                    ],
                ]);
            }

            $user->subtract(
                round($bet / 100, 2),
                "usd",
                $gamestatus,
                json_encode(["game" => $gameid, "round" => $roundid])
            );
        }

        if ($win > 0) {
            $user->add(
                round($win / 100, 2),
                "usd",
                $gamestatus,
                json_encode(["game" => $gameid, "round" => $roundid])
            );
        }

        if ($final === "1" and $bonusmode === "0") {
            $getwager = BalanceLog::where("internal", "=", $roundid)->first();
            $decode = json_decode($getwager, true);
			$getwager = number_format($decode["subtract"] * 100, 0, ".", "") ?? 0;
            $game = GameHistory::create([
                "u" => $playerId,
                "win" => $win,
                "bet" => $getwager,
                "gameid" => $gameid,
                "curr" => $currency,
                "meta" => null,
            ]);
            UserController::processGame($playerId, $decode["subtract"], round($win / 100, 2), $gameid);
			event(new \App\Events\LiveFeed($game, 2000));
        }

        return response()->json([
            "status" => "ok",
            "result" => [
                "balance" => number_format($user->balance() * 100, 0, ".", ""),
                "freegames" => 0,
            ],
        ]);
    }
}
