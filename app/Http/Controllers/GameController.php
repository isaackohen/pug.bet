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

class GameController extends Controller
{
    public function getBalance(Request $request)
    {
        $playerId = $request["playerid"];
        $currency = $request["currency"];
        $user = \App\Models\User::where("_id", $playerId)->first();
        $balancenumber = number_format($user->usd * 100, 0, ".", "");

        return response()
            ->json(["status" => "ok", "result" => ["balance" => $balancenumber, "freegames" => 0, ], ]);
    }

    public function slotsgame($game)
    {
        $currency = 'usd';
        $game = DB::table('slotslist')->where('_id', '=', $game)->first();

        if ($game['type'] === 'live' && $game['p'] !== 'upgames')
        {
            return redirect('/slots/real/live/' . $game['_id']);
        };

        if (auth()->user()
            ->balance() === '0')
        {
            redirect('slots.demo');
        };
        $playerid = auth()->user()->_id;
        $apigamble_apikey = 'F158EA0AFC6CFC5F91E29790BBC6FCC0';

        if ($game['ext'] === 'rise')
        {
            $construct = "http://slots.apigamble.com/api/callback/riseslots?provider=" . $game['p'] . "&subgame=" . $game['_id'] . "&userid=" . $playerid . "-usd&operator=62";
        }
        else
        {
            $construct = 'https://apigamble.com/api/slots/createSession/' . $apigamble_apikey . '/' . $playerid . '-' . $currency . '/' . $game['_id'] . '/usd';
        }

        $response = json_decode(file_get_contents($construct) , true);
        $url = $response['url'];

        $slotslist = DB::table('slotslist')->get();
        $filter = $slotslist->where('_id', '=', $slotslist)->first();

        return view('slots/play')
            ->with('id_game', $game)->with('name_game', $filter)->with('url', $url);

    }
    public function livegame($game)
    {
        $currency = 'usd';
        $game = DB::table('slotslist')->where('_id', '=', $game)->first();

        $subgame = $game['u_id'];
        $provider = $game['p'];
        $playerid = auth()->user()->_id;
        $playername = auth()->user()->name;
        if ($game['_id'] === 'evo_blackjack_lobby' || $game['_id'] === 'evo_roulette_lobby' || $game['_id'] === 'evo_baccarat_lobby')
        {
            $construct = 'http://slots.apigamble.com/api/callback/riselive?provider=' . $provider . '&subgame=0&category=blackjack&name=' . $playername . '&userid=' . $playerid . '-usd&operator=62';
        }

        $construct = 'http://slots.apigamble.com/api/callback/riselive?provider=' . $provider . '&subgame=' . $subgame . '&name=' . $playername . '&userid=' . $playerid . '-usd&operator=62';
        $response = Http::get($construct);
        //Log::warning($response);
        //Log::warning($construct);
        $url = $response['url'];

        return view('slots/play')->with('id_game', $provider)->with('name_game', 'livegame')
            ->with('url', $url);
    }

    public function pokerCallback(Request $request)
    {
        Log::notice($request);
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

        $gamestatus = "game";
        if ($final === "1")
        {
            $gamestatus = "game_final";
        }

        if ($bet > 0)
        {
            if (round($bet / 100, 2) > $user->balance())
            {
                return response()
                    ->json(["status" => "error", "error" => ["scope" => "user", "no_refund" => "1", "message" => "Not enough money", ], ]);
            }

            $user->subtract(round($bet / 100, 2) , "usd", $gamestatus, json_encode(["game" => $gameid, "round" => $roundid]));
        }

        if ($win > 0)
        {
            $user->add(round($win / 100, 2) , "usd", $gamestatus, json_encode(["game" => $gameid, "round" => $roundid]));
        }

        if ($final === "1")
        {
            $getwager = BalanceLog::where("internal", "=", $roundid)->first();
            $decode = json_decode($getwager, true);
            $getwager = number_format($decode["subtract"] * 100, 0, ".", "") ? ? 0;
            $game = GameHistory::create(["u" => $playerId, "win" => $win, "bet" => $getwager, "gameid" => $gameid, "curr" => $currency, "meta" => null, ]);
            event(new \App\Events\LiveFeed($game, 2000));
        }

        return response()->json(["status" => "ok", "result" => ["balance" => number_format($user->balance() * 100, 0, ".", "") , "freegames" => 0, ], ]);
    }
}

