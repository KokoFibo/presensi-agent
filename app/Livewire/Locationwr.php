<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Location;

class Locationwr extends Component
{
    public $location;
    public $show, $is_update, $id;


    public function delete($id)
    {
        $data = Location::find($id);
        $data->delete();
    }

    public function edit($id)
    {
        $this->id = $id;
        $this->show = true;
        $this->is_update = true;
        $data = Location::find($this->id);
        $this->location = $data->location;
    }

    public function update()
    {
        $this->validate();
        $data = Location::find($this->id);
        $data->location = $this->location;

        $data->save();
        $this->reset();

        $this->show = false;
        $this->is_update = false;
    }
    public function cancel()
    {
        $this->clear_data();
        $this->show = false;
    }
    public function new()
    {
        $this->clear_data();
        $this->show = true;
    }

    public function clear_data()
    {
        $this->location = '';
    }

    public function mount()
    {
        $this->reset();
        $this->show = false;
        $this->is_update = false;


        // $this->clear_data();
    }

    protected $rules = [
        'location' => 'required|min:3',
    ];
    public function save()
    {
        $this->validate();
        $data = new Location;
        $data->location = $this->location;
        $data->save();
        $this->reset();
        $this->show = false;
    }
    public function render()
    {
        $data = Location::orderBy('location', 'asc')->get();
        return view('livewire.locationwr', [
            'data' => $data
        ]);
    }
}
