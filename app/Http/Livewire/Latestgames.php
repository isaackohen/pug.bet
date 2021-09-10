<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;

class Latestgames extends Component
{
    use Actions;

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
        $user = \App\Models\User::where('_id', $user)->first();

        $this->dialog()->confirm([
            'title'       => '<b>'.$user->name.'</b> - VIP Level <span class="text-primary font-md">'.$user->viplevel.'</span><br><i><small>Member since '.$user->created_at.'</i></small>',
            'description' =>  'Amount Wagered: <b>'.$stats->usd_wager.'$</b>
            <br>Games Played:  <b>'.$stats->usd_games.'</b>
            <br>Biggest Win: <b>'.$stats->biggest.'$</b>
            <br>Luckiest Win: <b>'.$stats->luckiest.'x multiplier</b>
            ',
            'acceptLabel' => 'Ok',
                        'icon'        => 'info',

                        'style' => 'inline'

        ]);
}

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $rowlength;

    public function render()
    {
        return view('livewire.latestgames');
    }
}
