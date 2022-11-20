<?php

namespace App\Http\Livewire\Students;

use App\Models\Class_;
use App\Services\ParentService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Student as StudentModel;

class Student extends Component
{
    use LivewireAlert;

    public StudentModel $student;
    public $classes;
    public $bus_stop;
    public $class_scores = [];
    public $parent = [
        'name',
        'mobile_number',
        'email',
        'town',
        'address'
    ];
    protected $rules = [
        'update_student.first_name' => 'required|string',
        'update_student.last_name' => 'required|string',
        'update_student.dob' => 'required|date',
        'update_student.other_names' => 'nullable|string',
        'update_student.bus_stop' => 'nullable',
    ];
    public $update_student = [];
    public $promote_to;
    public $new_profile_image;

    protected $validationAttributes = [
        'update_student.class_' => 'class',
        'update_student.first_name' => 'first name',
        'update_student.last_name' => 'last name',
        'update_student.other_names' => 'other names',
        'update_student.parent_' => 'parent',
        'update_student.dob' => 'date of birth',
        'promote_to' => 'promoting class',
        'parent.name' => "parent's name",
        'parent.mobile_number' => "parent's mobile number",
        'parent.email' => "parent's email",
        'parent.town' => "parent's town",
        'parent.address' => "parent's address",
    ];

    public function render()
    {
        $this->update_student['first_name'] = $this->student->first_name;
        $this->update_student['last_name'] = $this->student->last_name;
        $this->update_student['other_names'] = $this->student->other_names;
        $this->update_student['dob'] = $this->student->dob;
        $this->classes = Class_::all()->except(['id' => $this->student->class__id]);

        $this->parent['name'] = $this->student->parent->name;
        $this->parent['mobile_number'] = $this->student->parent->mobile_number;
        $this->parent['email'] = $this->student->parent->email;
        $this->parent['town'] = $this->student->parent->town;
        $this->parent['address'] = $this->student->parent->address;
        $this->bus_stop = $this->student->busStop;

//        $this->class_scores = $this->student->classScores->groupBy('semester_id');

        return view('livewire.students.student');
    }

    public function mount(){
        $this->update_student['bus_stop'] = $this->student->busStop ? $this->student->busStop->id : null;
    }
    public function update(){
        $this->validate();
//        dd($this->update_student['bus_stop']);
        $this->student->update([
            'first_name' => $this->update_student['first_name'],
            'last_name' => $this->update_student['last_name'],
            'other_names' => $this->update_student['other_names'],
            'dob' => $this->update_student['dob'],
            'bus_stop_id' => $this->update_student['bus_stop'] == 'null' ? null : $this->update_student['bus_stop'],
        ]);

        $this->bus_stop = $this->student->busStop;
        $this->alert('success', "Student updated successfully");
    }

    public function promote(){
        $this->validate([
            'promote_to' => 'required|exists:class_,id',
        ]);
//        dd($this->student->classSemesterRecords);
        $student = promoteStudent($this->student, $this->promote_to);
        $this->alert('success', "Student promoted successfully");
    }

    public function updateParent(){
        $this->validate([
            'parent.name' => 'string|required',
            'parent.mobile_number' => 'string|required',
            'parent.email' => 'email|nullable',
            'parent.town' => 'string|nullable',
            'parent.address' => 'string|nullable',
        ]);
        $parent = $this->student->parent;
        $parent = (new ParentService())->update($parent, $this->parent);
        $this->alert('success', "Parent's details updated successfully");
    }

//    public function changeProfileImage(){
//        $this->validate([
//            'new_profile_image' => 'required|image|max:2024'
//        ]);
//        $newImagePath = $this->new_profile_image->store('students', 'public_uploads');
//        $this->student->update([
//            'profile_image' => $newImagePath
//        ]);
//        $this->alert(message: "profile image updated successfully");
//    }

}
