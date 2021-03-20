<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule; 
use Livewire\Component;
use Livewire\WithPagination;

class Clients extends Component
{
    public function render()
    {
        return view('livewire.clients');
    }
}
