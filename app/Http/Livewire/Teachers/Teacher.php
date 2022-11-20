<?php

namespace App\Http\Livewire\Teachers;

use App\Services\TeacherService;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Teacher as TeacherModel;

class Teacher extends Component
{
    use LivewireAlert;

    public TeacherModel $teacher;
    public $classes = [];
    public $update_teacher = [];

    public function render()
    {
        foreach ($this->teacher->classes as $class){
            $this->classes[$class->id] = $class;
        }
        $this->update_teacher = [
            'name' => $this->teacher->name,
            'username' => $this->teacher->username,
            'mobile_number' => $this->teacher->mobile_number,
            'email' => $this->teacher->email,
            'salary' => $this->teacher->salary,
            'certificate' => $this->teacher->certificate,
        ];
        return view('livewire.teachers.teacher');
    }

    public function update(){
        $this->validate([
            'update_teacher.name' => ['required', 'string'],
            'update_teacher.username' => ['string', Rule::unique('teachers', 'username')->ignore($this->teacher->id)],
            'update_teacher.mobile_number' => ['string', Rule::unique('teachers', 'mobile_number')->ignore($this->teacher->id)],
            'update_teacher.email' => ['nullable', 'string', Rule::unique('teachers', 'mobile_number')->ignore($this->teacher->id)],
            'update_teacher.salary' => ['required', 'string'],
            'update_teacher.certificate' => ['nullable', 'string'],
        ]);
        $data = [
            'name' => $this->update_teacher['name'],
            'username' => $this->update_teacher['username'],
            'mobile_number' => $this->update_teacher['mobile_number'],
            'email' => $this->update_teacher['email'],
            'salary' => $this->update_teacher['salary'],
            'certificate' => $this->update_teacher['certificate'],
        ];
        $this->teacher = (new TeacherService())->update($this->teacher, $data);
        $this->alert(message: "Teacher's info updated successfully");
    }
}
