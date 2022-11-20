<?php

namespace App\Http\Livewire\Semesters;

use App\Services\SemesterService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Semester as SemesterModel;

class Semester extends Component
{
    use LivewireAlert;

    public SemesterModel $semester;
    public $fees;

    public $name;
    public $description;
    public $start_date;
    public $end_date;

    public function render()
    {
        $this->name = $this->semester->name;
        $this->description = $this->semester->description;
        $this->start_date = $this->semester->start_date;
        $this->end_date = $this->semester->end_date;
        $this->fees = $this->semester->fees;
        return view('livewire.semesters.semester');
    }

    public function update(){
        $this->validate([
            'name' => ['required', Rule::unique('semesters')->ignore($this->semester->id), 'string'],
            'description' => ['nullable', 'string'],
            'start_date' => ['required', 'date', Rule::unique('semesters')->ignore($this->semester->id)],
            'end_date' => ['nullable', 'date', Rule::unique('semesters')->ignore($this->semester->id)],
        ]);
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
        (new SemesterService())->update($this->semester, $data);
        $this->alert(message: "Semester updated successfully");
    }

    public function markAsEnded(){
        try {
            DB::beginTransaction();
            $this->semester->update([
                'is_ended' => true,
                'end_date' => $this->semester->end_date == null ? today() : $this->semester->end_date
            ]);
            DB::commit();
            $this->alert(message: "You have successfully end this semester");
        } catch (\Exception $exception){
            DB::rollBack();
            if (str_contains($exception->getMessage(), 'Duplicate entry')) {
                $this->alert(type: 'warning', message: "please set semester end date as there's already a semester which ended today, and two semesters cannot have the same end date");
            }
        }
    }
}
