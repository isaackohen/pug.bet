<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class VipProgress extends Component
{

    public $currentvip;
    public $progressvip;
    public $goalvip;
    public $percentVip;
    
    public function mount()
    {
        $user = auth()->user();
        $this->currentvip = $user->viplevel;
        $this->progressvip = \App\Models\User::progressVip($user->_id);
        $this->percentVip = auth()->user()->vipPercent();
    }


public function renderPercent()
{
    $percentVip = auth()->user()->vipPercent();


    return $percentVip;
}



    public function render()
    {
        return view('livewire.profile.vip-progress');
    }
}
 