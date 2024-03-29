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
        $slots = DB::table('slotslist')->where('p', '!=', 'playstar')->where('d', '!=', '1')->where('p', '!=', 'upgames')->simplePaginate(132);
        return view('slots/slotslist', compact('slots'));
    }


    public function providerPage($provider)
    {
        $slots = DB::table('slotslist')->where('p', '=', $provider)->simplePaginate(132);

        return view('slots/slotslist', compact('slots'));
    }

    public function livecasinoPage()
    {
        $slotslist = DB::table('slotslist')->where('type', '=', 'live')->where('d', '!=', '1')->where('p', '!=', 'upgames')->get();
        return view('livewire.livecasino', ['slots' => $slotslist]);
    }

    // Start free spin session slots game //
    public function slotsgameFreespins($game)
    {  
        $currency = 'usd';
        $game = DB::table('slotslist')->where('_id', '=', $game)->first();
        if($game['type'] === 'live' && $game['p'] !== 'upgames') { return redirect('/slots/real/live/'.$game['_id']);};
        //if(auth()->user()->balance() === '0') { redirect('slots.demo');};
        $user = auth()->user();
        $getcurrentViplevels = \App\Models\VIP\VipLevels::where('level', '=', ($user->viplevel))->first();

        if(auth()->user()->freespins > 0 and $getcurrentViplevels->fs_superspin === '0') {
        $construct = "https://api.bulk.bet/v2/createSession?apikey=2C678B78219C3F4EABEBFA8149C1A2F2&userid=".$user->_id."-".$currency."&game=".$game['_id'].'&freespins='.auth()->user()->freespins.'&freespins_value=0.3&mode=bonus';
        } else {
        $construct = "https://api.bulk.bet/v2/createSession?apikey=2C678B78219C3F4EABEBFA8149C1A2F2&userid=".$user->_id."-".$currency."&game=".$game['_id'];
        }

        $user->update([
                'freespins' => 0
        ]);
        
        $response = json_decode(file_get_contents($construct), true);
        $url = $response['url'];
        $slotslist = DB::table('slotslist')->get();
        $filter = $game;

    return view('slots/play')->with('mode', 'Free Spins Mode')->with('id_game', $game['_id'])->with('name_game', $filter)->with('url', $url);   
    }

    // Start slots game //
    public function slotsgame($game)
    {
        $currency = 'usd';
        $game = DB::table('slotslist')->where('_id', '=', $game)->first();
        if($game['type'] === 'live' && $game['p'] !== 'upgames') { return redirect('/slots/real/live/'.$game['_id']);};
        $playerid = auth()->user()->_id;
        $construct = "https://api.bulk.bet/v2/createSession?apikey=2C678B78219C3F4EABEBFA8149C1A2F2&userid=".$playerid."-".$currency."&game=".$game['_id'];
       
        $response = json_decode(file_get_contents($construct), true);
        $url = $response['url'];
        $slotslist = DB::table('slotslist')->get();
        $filter = $slotslist->where('_id', '=', $game['_id'])->first();

        return view('slots/play')->with('mode', 'Real Mode')->with('id_game', $game['_id'])->with('name_game', $filter)->with('url', $url);   
    }

    public function slotsgameDemo($game)
    {
        $slotslist = DB::table('slotslist')->get();
        $filter = $slotslist->where('_id', '=', $game)->first();
        if($filter['ext'] !== "c2") return redirect('/slots/real/'.$filter['_id']);

        $construct = "https://api.bulk.bet/v2/createSession?apikey=2C678B78219C3F4EABEBFA8149C1A2F2&userid=demo-usd&game=".$game.'&mode=demo';
        $response = json_decode(file_get_contents($construct), true);
        $url = $response['url'];

        return view('slots/play')->with('mode', 'Demo Mode')->with('id_game', $filter['_id'])->with('name_game', $filter)->with('url', $url);   
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
        $filter = $game;

        return view('slots/play')->with('mode', 'Real Mode')->with('id_game', $game['_id'])->with('name_game', $filter)->with('url', $url);   
        }

    // Callbacks //
    public function simpleXmlToArray($xmlObject, $out = array ())
    {
        foreach ($xmlObject as $index => $node ){
            if(count($node) === 0){
                $out[$node->getName()] = $node->__toString ();
            }else{
                $out[$node->getName()][] = $this->simpleXmlToArray($node);
            }
        }

        return $out;
    }
    public function pokerCallback(Request $request)
    {
        $content = json_decode($request->getContent());
        Log::notice($content);
        Log::notice($request);
        $xmlstr = <<<XML
        <balanceget id="1" Code="200" AmountPlay="123" AmountReal="345"
        AmountBonus="456" PlayerId="613a3f23efea" />
        XML;

        header('Content-type: text/xml; charset=utf-8');
        $xmlDoc = new \SimpleXMLElement($xmlstr);
        echo $xmlDoc->asXML();
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
                "meta" => $roundid ?? 0,
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
