<?php

namespace App\Http\Livewire\Students;

use App\Models\Class_;
use App\Models\Parent_;
use App\Services\BillService;
use App\Services\ParentService;
use App\Services\StudentService;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use LivewireAlert, WithFileUploads;

    public $use_existing_parent = 'Yes';
    public $classes;
    public $parents;
    public $profile_image;
    public $student = [
        'class_', 'parent_', 'first_name', 'last_name', 'dob', 'other_names', 'bus_stop',
    ];
    public $parent = [
        'name',
        'mobile_number',
        'email',
        'town',
        'address'
    ];
    protected $rules = [
        'student.class_' => 'required|exists:class_,id',
        'student.first_name' => 'required|string',
        'student.last_name' => 'required|string',
        'student.dob' => 'required|date',
        'student.other_names' => 'nullable|string',
        'student.bus_stop' => 'nullable',
        'use_existing_parent' => 'required',
        'profile_image' => 'nullable|image|max:2024',

    ];
    protected $messages = [
        'parent.name.required' => "The parent's name field is required.",
        'parent.mobile_number.required' => "The parent's mobile number field is required.",
    ];
    protected $validationAttributes = [
        'student.class_' => 'class',
        'student.first_name' => 'first name',
        'student.last_name' => 'last name',
        'student.other_names' => 'other names',
        'student.parent_' => 'parent',
        'student.dob' => 'date of birth',
        'student.bus_stop' => 'bus stop',
        ######################################
        'parent.name' => "parent's full name",
        'parent.mobile_number' => "parent's mobile number",
        'parent.email' => "parent's email",
        'parent.town' => "parent's town",
        'parent.address' => "parent's address",
    ];


    public function render()
    {
        $this->classes = Class_::all();
        $this->parents = Parent_::all();
        return view('livewire.students.add');
    }

    public function admit(){
        $this->validate();
        if ($this->use_existing_parent == 'Yes'){
            $this->validate([
                'student.parent_' => 'required|exists:parents,id'
            ]);
        }
        else{
            $this->validate([
                'parent.name' => 'required|string',
                'parent.mobile_number' => 'required|string',
                'parent.email' => 'nullable|string',
                'parent.town' => 'nullable|string',
                'parent.address' => 'nullable|string',
            ]);
        }
        try {
            DB::beginTransaction();
            $studentService = new StudentService();
            if ($this->use_existing_parent !== 'Yes' ){
                $parent = (new ParentService())->store($this->parent);
                $this->student['parent_'] =  $parent->id;
            }
            if (isset($this->student['profile_image'])){
                $image_path = $this->profile_image->store('uploaded_images/students', 'public_uploads');
                $this->student['profile_image'] = $image_path;
            }


//            if ($this->student['bus_stop'] == 'null') $this->student['bus_stop'] = null;
            $student = $studentService->store($this->student);
            // create class scores
            createStudentClassScores($student, $student->class);
            // create student class semester record
            $student->classSemesterRecords()->create([
                'class__id' => $student->class->id,
                'semester_id' => currentSemester()->id
            ]);
            // create fees bill of current semester for student
            $fee = currentSemester()->fee;
            if($fee) (new BillService())->store($student, $fee->total_amount, 'fee', $fee->id);
            DB::commit();
            $this->alert('success', 'Student admitted successfully.');
            return redirect()->to(route('students.student', $student));
        }
        catch (\Exception $exception){
            DB::rollBack();
            $this->alert('error', 'Student could not be admitted'.$exception->getMessage());
        }
    }
}
