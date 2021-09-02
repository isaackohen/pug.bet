<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Slotlist extends Component
{
    public $slotslist;
    public $slots;

    public function render()
    {
        return view('livewire.slotlist');
    }
}



    
