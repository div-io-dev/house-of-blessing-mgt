<?php

namespace App\Http\Livewire\Fees;

use App\Models\Fee;
use Livewire\Component;

class Fees extends Component
{
    public $fees;

    public function render()
    {
        $this->fees = Fee::all();
        return view('livewire.fees.fees');
    }
}
