<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Index extends Component
{
    public $contentIsVisible;

    public function render()
    {
        return view('livewire.index');
    }
}
