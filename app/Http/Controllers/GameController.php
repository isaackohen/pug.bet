<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\BalanceLog;
use App\Models\GameHistory;
use App\Http\Livewire\Component;
use App\Http\Livewire\Latestgames;

class GameController extends Controller
{
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

        if ($final === "1") {
            $getwager = BalanceLog::where("internal", "=", $roundid)->first();
            $decode = json_decode($getwager, true);
            $getwager =
			number_format($decode["subtract"] * 100, 0, ".", "") ?? 0;
            $game = GameHistory::create([
                "u" => $playerId,
                "win" => $win,
                "bet" => $getwager,
                "gameid" => $gameid,
                "curr" => $currency,
                "meta" => null,
            ]);
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
