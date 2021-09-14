<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;

class JackpotInfo extends Component
{
    public $jackpot_sum;
    public $jackpot_contribution;
    public $jackpot_base;
    public $jackpot_chance;
    public $jackpot_min;


    public function mount()
    {      
        $this->jackpot_sum = number_format(\App\Models\Settings::where('key', '=', 'jackpot_sum')->first()->value, 2, ".", "");
        $this->jackpot_contribution = number_format(\App\Models\Settings::where('key', '=', 'jackpot_contribution')->first()->value, 2, ".", "");
        $this->jackpot_base = number_format(\App\Models\Settings::where('key', '=', 'jackpot_base')->first()->value, 2, ".", "");
        $this->jackpot_chance = \App\Models\Settings::where('key', '=', 'jackpot_chance')->first()->value;
        $this->jackpot_min = number_format(\App\Models\Settings::where('key', '=', 'jackpot_min')->first()->value, 2, ".", "");
    }
    public function render()
    {
        return view('livewire.modals.jackpot-info');
    }
}
