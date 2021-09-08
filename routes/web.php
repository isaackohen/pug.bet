<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Slots;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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










Route::get('/bonus', function () {
    return view('bonus-page');
})->name('bonus');



    


Route::middleware(['auth:sanctum'])->get('/slots', function () {
    $slots = DB::table('slotslist')->simplePaginate(60);
      return view('slots/slotslist', compact('slots'));
})->name('slots');




Route::get('/slotstest', [App\Http\Controllers\Controller::class, 'getSlots']);




//slots



Route::middleware(['auth:sanctum'])->get('/slots/demo/{game}', function ($game) { 
    $apigamble_apikey = Controller::operatorkey();
    $construct = 'https://api.bulk.bet/api/slots/createDemoSession/'.$apigamble_apikey.'/'.$game;
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];

    $slotslist = DB::table('slotslist')->get();
    $filter = $slotslist->where('_id', '=', $slotslist)->first();

    return view('slots/play')->with('id_game', $game)->with('name_game', $filter)->with('url', $url);           
})->name('slots.demo');

Route::middleware(['auth:sanctum'])->get('/poker', function () { 

    return view('poker-page');           
})->name('poker');

Route::middleware(['auth:sanctum'])->get('/slots/real/live/{game}', 'App\Http\Controllers\GameController@livegame')->name('live.direct');

Route::middleware(['auth:sanctum'])->get('/slots/real/{game}', 'App\Http\Controllers\GameController@slotsgame')->name('slots.direct');

Route::middleware(['auth:sanctum'])->get('/slots/real/live/lobby/{provider}', function ($provider) { 
    $currency = 'usd';
    $playerid = auth()->user()->_id;
    $playername = auth()->user()->name;
    $subgame = 0;
    $construct = "http://slots.apigamble.com/api/callback/riselive?provider='.$provider.'&subgame='.$subgame.'&name='.$playername.'&userid='.$playerid.'-usd&operator=62";
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];


    return view('slots/play')->with('id_game', $provider)->with('name_game', 'livegame')->with('url', $url);           
})->name('live.lobby');






      


