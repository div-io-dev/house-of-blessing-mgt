<?php

namespace App\Http\Livewire\Fees;

use App\Models\Class_;
use Livewire\Component;
use \App\Models\Fee;

class EditFee extends Component
{
    public Fee $fee;
    public $classes;
    public $existing_classes_ids = [];
    public $items = [];


    public $new_item_name = '';
    public $new_item_price = '';
    public $items_string;
    public $existing_classes_ids_model;


    public function render()
    {
        $this->classes = Class_::all();
        return view('livewire.fees.edit-fee');
    }

    public function mount(){
        $this->existing_classes_ids = $this->fee->classes->pluck('id')->toArray();
        $this->existing_classes_ids_model = json_encode($this->existing_classes_ids);
        $this->items = $this->fee->items;
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
