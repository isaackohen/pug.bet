<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Slots;

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


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//        ->extends('layouts.app')


*/


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/slots', function () {
    $slotslist = DB::table('slotslist')->get();
    return view('slots/slotslist', ['slots' => $slotslist]);
})->name('slots');

Route::middleware(['auth:sanctum', 'verified'])->get('/slots/demo/{game}', function ($game) { 
    $apigamble_apikey = 'F158EA0AFC6CFC5F91E29790BBC6FCC0';
    $construct = 'https://apigamble.com/api/slots/createDemoSession/'.$apigamble_apikey.'/'.$game;
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];

    $slotslist = DB::table('slotslist')->get();
    $filter = $slotslist->where('_id', '=', $slotslist)->first();

    return view('slots/play')->with('id_game', $game)->with('name_game', $filter)->with('url', $url);           
})->name('slots.demo');


Route::middleware(['auth:sanctum', 'verified'])->get('/slots/real/{game}', function ($game) { 
    $currency = 'usd';
    $playerid = auth()->user()->_id;
    $apigamble_apikey = 'F158EA0AFC6CFC5F91E29790BBC6FCC0';
    $construct = 'https://apigamble.com/api/slots/createSession/'.$apigamble_apikey.'/'.$playerid.'-'.$currency.'/'.$game.'/usd';
    $response = json_decode(file_get_contents($construct), true);
    $url = $response['url'];

    $slotslist = DB::table('slotslist')->get();
    $filter = $slotslist->where('_id', '=', $slotslist)->first();

    return view('slots/play')->with('id_game', $game)->with('name_game', $filter)->with('url', $url);           
})->name('slots.real');




