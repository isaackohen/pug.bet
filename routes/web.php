<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Slots;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;
use Laravel\Jetstream\Jetstream;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
    return view('livewire.show-posts')
        ->layout('layouts.base', ['title' => 'Show Posts'])
}

*/


            //http://slots.apigamble.com/api/callback/riselive?provider=evolution&subgame=0&userid=6132c49351836a34fb1ebcf2-btc&operator=62


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->get('/livecasino', function () {
    $slotslist = DB::table('slotslist')->where('type', '=', 'live')->get();
    return view('livewire.livecasino', ['slots' => $slotslist]);
})->name('livecasino');


Route::middleware(['auth:sanctum', 'verified'])->get('/payment/paydash/{orderid}', function ($orderid) {
    $redirectURL = "https://paydash.co.uk/checkout/" . $orderid;
    return view('livewire/paydash-orderpage', ['url' => $redirectURL]);
})->name('paydash-orderpage');



Route::middleware(['auth:sanctum'])->get('/slots', function () {
    $slotslist = DB::table('slotslist')->get();
    return view('slots/slotslist', ['slots' => $slotslist]);
})->name('slots');




Route::middleware(['auth:sanctum'])->get('/slots/demo/{game}', function ($game) { 
    $apigamble_apikey = 'F158EA0AFC6CFC5F91E29790BBC6FCC0';
    $construct = 'https://apigamble.com/api/slots/createDemoSession/'.$apigamble_apikey.'/'.$game;
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];

    $slotslist = DB::table('slotslist')->get();
    $filter = $slotslist->where('_id', '=', $slotslist)->first();

    return view('slots/play')->with('id_game', $game)->with('name_game', $filter)->with('url', $url);           
})->name('slots.demo');

Route::middleware(['auth:sanctum'])->get('/poker', function () { 

    return view('poker-page');           
})->name('poker');


Route::middleware(['auth:sanctum'])->get('/slots/real/{game}', function ($game) { 
    $currency = 'usd';
    $game = DB::table('slotslist')->where('_id', '=', $game)->first();

    if($game['type'] === 'live' && $game['p'] !== 'upgames') { return redirect('/slots/real/live/'.$game['_id']);};

    if(auth()->user()->balance() === '0') { redirect('slots.demo');};
    $playerid = auth()->user()->_id;
    $apigamble_apikey = 'F158EA0AFC6CFC5F91E29790BBC6FCC0';
    if($game['ext'] === 'rise'){
    $construct = 'http://slots.apigamble.com/api/callback/riseslots?provider='.$game['p'].'&subgame='.$game['_id'].'&userid='.$playerid.'-usd&operator=62';
    Log::notice($construct);
    } else {
    $construct = 'https://apigamble.com/api/slots/createSession/'.$apigamble_apikey.'/'.$playerid.'-'.$currency.'/'.$game['_id'].'/usd';
    }
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];



    $slotslist = DB::table('slotslist')->get();
    $filter = $slotslist->where('_id', '=', $slotslist)->first();

    return view('slots/play')->with('id_game', $game)->with('name_game', $filter)->with('url', $url);           
})->name('slots.real');

Route::middleware(['auth:sanctum'])->get('/slots/real/live/lobby/{provider}', function ($provider) { 
    $currency = 'usd';
    $playerid = auth()->user()->_id;
    $playername = auth()->user()->name;
    $subgame = 0;
    $construct = 'http://slots.apigamble.com/api/callback/riselive?provider='.$provider.'&subgame='.$subgame.'&name='.$playername.'&userid='.$playerid.'-usd&operator=62';
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];


    return view('slots/play')->with('id_game', $provider)->with('name_game', 'livegame')->with('url', $url);           
})->name('live.lobby');


Route::middleware(['auth:sanctum'])->get('/slots/real/live/{game}', function ($game) { 
    $currency = 'usd';
    $game = DB::table('slotslist')->where('_id', '=', $game)->first();

    $subgame = $game['u_id'];
    $provider = $game['p'];
    $playerid = auth()->user()->_id;
    $playername = auth()->user()->name;
    if($game['_id'] === 'evo_blackjack_lobby' || $game['_id'] === 'evo_roulette_lobby' || $game['_id'] === 'evo_baccarat_lobby'){
    $construct = 'http://slots.apigamble.com/api/callback/riselive?provider='.$provider.'&subgame=0&category=blackjack&name='.$playername.'&userid='.$playerid.'-usd&operator=62';
    }

    $construct = 'http://slots.apigamble.com/api/callback/riselive?provider='.$provider.'&subgame='.$subgame.'&name='.$playername.'&userid='.$playerid.'-usd&operator=62';
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];


    return view('slots/play')->with('id_game', $provider)->with('name_game', 'livegame')->with('url', $url);           
})->name('live.direct');


