<?php

namespace App\Http\Livewire\Teachers;

use App\Services\TeacherService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Teacher as TeacherModel;
use Livewire\WithFileUploads;

class Teachers extends Component
{
    use LivewireAlert, WithFileUploads;

    public $teachers;
    public $new_teacher = [
        'name',
        'username',
        'mobile_number',
        'salary',
        'email',
        'certificate',
        'certificate_file',
        'profile_image_file'
    ];
    public $new_teacher_certificate_file;
    public $new_teacher_profile_image_file;
    protected $validationAttributes = [
        'new_teacher.name' => 'name',
        'new_teacher.username' => 'username',
        'new_teacher.mobile_number' => 'mobile number',
        'new_teacher.salary' => 'salary',
        'new_teacher.email' => 'email',
        'new_teacher.certificate' => 'certificate',
        'new_teacher.certificate_file' => 'certificate image',
        'new_teacher.profile_image_file' => 'profile image',
    ];


    public function render()
    {
        $this->teachers = TeacherModel::all();
        return view('livewire.teachers.teachers');
    }

    public function addTeacher(){
        $this->validate([
            'new_teacher.name' => 'required',
            'new_teacher.username' => 'required|required|unique:teachers,username',
            'new_teacher.mobile_number' => 'required|required|unique:teachers,mobile_number',
            'new_teacher.salary' => 'required|string',
            'new_teacher.email' => 'email|nullable|string',
            'new_teacher.certificate' => 'required|string',
            'new_teacher_certificate_file' => 'required|image|max:2024',
            'new_teacher_profile_image_file' => 'required|image|max:2024',
        ]);
        $this->new_teacher['certificate_path'] = $this->new_teacher_certificate_file
            ->store('uploaded_images/teachers/certificates', 'public_uploads');
        $this->new_teacher['profile_image_path'] = $this->new_teacher_profile_image_file
            ->store('uploaded_images/teachers/profile_images', 'public_uploads');
        $teacher = (new TeacherService())->create($this->new_teacher);
        $this->reset('new_teacher');
        $this->redirect(route('teachers.teacher', $teacher->id));
        $this->alert(message: "A new teacher has been added successfully");
    }
}
