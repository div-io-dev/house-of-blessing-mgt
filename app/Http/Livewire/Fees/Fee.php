<?php

namespace App\Http\Livewire\Fees;

use Livewire\Component;
use App\Models\Fee as FeeModel;

class Fee extends Component
{
    public FeeModel $fee;
    public $semester;
    public $classes;
    public $bills;
    public $fee_debt = [];

    public function render()
    {
        $this->semester = $this->fee->semester;
        $this->classes = $this->fee->classes;
        $this->bills = $this->fee->bills;
        $this->fee_debt = feeDebt($this->fee);
        $this->fee_debt['collected_so_far'] = $this->bills->sum('amount') - $this->fee_debt['total_debt'];
        foreach ($this->classes as $class) $class->fee_info = feeInfoOfClass($this->fee, $class);
        return view('livewire.fees.fee');
    }
}
