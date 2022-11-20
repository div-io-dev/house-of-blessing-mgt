<?php

namespace App\Http\Livewire\Bills;

use Livewire\Component;
use \App\Models\Bill as BillModel;

class Bills extends Component
{
    public $bills;

    public function render()
    {
        $this->bills = BillModel::all();
        return view('livewire.bills.bills');
    }
}
