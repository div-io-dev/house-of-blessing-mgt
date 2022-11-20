<?php

namespace App\Http\Livewire\BusStops;

use App\Models\BusStop;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BusStops extends Component
{
    use LivewireAlert;

    public $bus_stops = [];
    public $new_bus_stop = [
        'town_name',
        'price',
        'kilometer' => null,
    ];

    public function render()
    {
        $this->bus_stops = BusStop::all();
        return view('livewire.bus-stops.bus-stops');
    }

    public function addBusStop(){
        $this->validate([
            'new_bus_stop.town_name' => ['required', 'string', 'unique:bus_stops,town_name'],
            'new_bus_stop.price' => ['required', 'regex:/^\d*(\.\d{2})?$/'],
            'new_bus_stop.kilometer' => ['nullable', 'regex:/^\d*(\.\d{2})?$/'],
        ]);
        $bus_stop = BusStop::create([
            'town_name' => $this->new_bus_stop['town_name'],
            'kilometers' => $this->new_bus_stop['kilometers'] ?? null,
            'price' => $this->new_bus_stop['price'],
        ]);
        $this->reset();
        $this->alert('success', 'Bus stop has been added successfully');
        return redirect()->to(route('bus_stops'));
    }
}
