<?php

namespace App\Http\Livewire\BusStops;

use App\Models\BusStop;
use Livewire\Component;

class BusStopInfo extends Component
{
    public BusStop $bus_stop;
    public $students = [];
    public function render()
    {
        $this->students = $this->bus_stop->students;
        return view('livewire.bus-stops.bus-stop-info');
    }
}
