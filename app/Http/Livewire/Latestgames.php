<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Latestgames extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public $rowlength;

    public function render()
    {
        return view('livewire.latestgames');
    }
}
