<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Presensi;

class Scan extends Component
{
    public $scan;

    public function updatedScan()
    {
        $is_checkIn = null;
        $is_checkIn = Presensi::where('user_id', auth()->user()->id)->whereDate('check_in', '2024-02-22')->first();
        if ($is_checkIn == null) {
            $data = new Presensi;
            $data->user_id = auth()->user()->id;
            $data->check_in = $this->scan;
            $data->save();
        } else {
            $data = Presensi::where('user_id', auth()->user()->id)->whereDate('check_in', '2024-02-22')->first();
            $data->user_id = auth()->user()->id;
            $data->check_out = $this->scan;
            $data->save();
        }
    }

    public function mount()
    {
        $this->scan = "";
    }
    public function render()
    {
        return view('livewire.scan');
    }
}
