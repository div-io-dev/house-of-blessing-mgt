<?php

namespace App\Http\Livewire\Classes;

use App\Models\Class_;
use App\Services\ClassService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AllClass extends Component
{
    use LivewireAlert;

    public $classes;
    public $new_class_name;
    protected $validationAttributes = [
        'new_class_name' => "class name",
    ];

    public function render()
    {
        $this->classes = Class_::all();
        return view('livewire.classes.all-class');
    }

    public function addClass(){
        $this->validate([
            'new_class_name' => "required|string|unique:class_,name",
        ]);
        $class = (new ClassService())->create($this->new_class_name);
        $this->alert(message: "Class with the name '$this->new_class_name' has been created successfully" );
        $this->reset(['new_class_name']);
    }
}
