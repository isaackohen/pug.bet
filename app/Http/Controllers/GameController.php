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
        $apigamble_apikey = env('OPERATOR_APIKEY');

        $construct = "https://api.bulk.bet/v2/createSession?apikey=2C678B78219C3F4EABEBFA8149C1A2F2&userid=".$playerid."-".$currency."&game=".$game['_id'];
       
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
        $apigamble_apikey = env('OPERATOR_APIKEY');

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

        $construct = 'https://api.bulk.bet/v2/createSession?apikey=2C678B78219C3F4EABEBFA8149C1A2F2&name='.$playername.'&userid='.$playerid.'-'.$currency.'&game='.$game['_id'];
 

            //Log::notice($url);
            $userdata = array('playerId' => $playername, "currency" => $currency);
            $jsonbody = json_encode($userdata);
            $curlcatalog = curl_init();
            curl_setopt_array($curlcatalog, array(
            CURLOPT_URL => $construct,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $jsonbody,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));
        
        $responsecurl = curl_exec($curlcatalog);
        curl_close($curlcatalog);
        $responsecurl = json_decode($responsecurl, true);
 

        $url = $responsecurl['url'];


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
			$getwager = number_format($decode["subtract"] * 100, 0, ".", "") ?? (0 * 100);
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
