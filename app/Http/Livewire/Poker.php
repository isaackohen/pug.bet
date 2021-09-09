<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\PokerApi;
use App\Http\Controllers\PokerHelper;
use Illuminate\Support\Facades\Log;



class Poker extends Component
{

    public $link;

    public function render()
    {

    $login = substr(auth()->user()->_id,0,12);
    $api = new PokerApi(PokerHelper::getPokerAffID(), PokerHelper::getPokerApikey(), '217.182.195.96', 4000);
    $api->connect();
    $playerid = $api->getIdByLogin($login);


    if($playerid === '0') {
    $password =  'test';
    $new = $api->createPlayer($login, $password, $login, $login, $login, '1','USA');
    $playerid = $api->getIdByLogin($login);
    }

    $getRunLink = $api->getRunLink($login); 
    $url = $getRunLink['uogetuserrunlink']['@attributes']['runlink'];
    $explode = explode('/', $url);
    $link = 'https://poker.apigamble.com/alogin/'.$explode[4].'/';

        return view('livewire.poker')->with('url', $link);
    }
}
