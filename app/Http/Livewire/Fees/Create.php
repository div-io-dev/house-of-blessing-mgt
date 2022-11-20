<?php

namespace App\Http\Livewire\Fees;

use App\Models\AcademicYear;
use App\Models\Class_;
use App\Models\Semester;
use App\Services\FeeService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use function PHPUnit\Framework\returnArgument;

class Create extends Component
{
    use LivewireAlert;

    public $semesters;
    public $semester;
    public $items_string;
    public $items = [
        'management system fee' => ['name' => 'management system fee', 'price' => '5']
    ];
    public $new_item_name;
    public $new_item_price;
    public $classes;

    public function render()
    {
        return view('livewire.fees.create');
    }

    public function mount(){
        $this->classes = Class_::all();
        $this->semesters = Semester::orderBy('created_at', 'DESC')->get();
        $this->items_string = json_encode($this->items);
    }

    public function addItem(){
        $this->validate([
            'new_item_name' => 'required',
            'new_item_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ]);
        $this->items[$this->new_item_name] = [
            'name' => $this->new_item_name,
            'price' => $this->new_item_price,
        ];
        $this->items_string = json_encode($this->items);
        $this->reset(['new_item_name', 'new_item_price']);
    }

    public function removeItem($key){
        unset($this->items[$key]);
        $this->items_string = json_encode($this->items);
    }

}
