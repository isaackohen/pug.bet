<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserProfile extends Component
{

    
    public $u;
    public $usd_wager;
    public $usd_win;
    public $usd_games;
    public $biggest;
    public $biggest_game;
    public $luckiest;
    public $luckiest_game;


public function showUser($user) {


        $stats = \App\Models\UserStatistics::where('u', $user)->first();

        $this->dialog()->confirm([
            'title'       => 'Your BITCOINGOLD Address',
            'description' =>  $stats->usd_wager,
            'acceptLabel' => 'Ok'
        ]);
}
  
    public function render()
    {
        return view('livewire.user-profile');
    }
}
  