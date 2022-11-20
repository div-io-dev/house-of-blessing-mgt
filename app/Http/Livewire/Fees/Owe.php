<?php

namespace App\Http\Livewire\Fees;

use App\Models\Student;
use Livewire\Component;

class Owe extends Component
{
    public array $students = [];
    public function render()
    {
        $all_students = Student::all()->where('amount_owing', '>', 0);

        foreach ($all_students as $std){
            $fees_owing = $std->bills()->where('billable_id', $std->id)
                ->where('type', 'fee')
                ->where('amount_left', '>', 0);
            if (count($fees_owing) > 0){
                $std->fees_amount_left = $fees_owing->sum('amount_left');
                $std->num_of_fees_owing = count($fees_owing);
                $std->fees_owing = $fees_owing;
                $this->students[] = $std;
            }
        }
        return view('livewire.fees.owe');
    }
}
