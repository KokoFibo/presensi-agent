<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Location;
use App\Models\Presensi;
use Livewire\Attributes\On;

class Scan extends Component
{
    public $scan;

    #[On('getScanResult')]
    public function getScanResult($value)
    {
        dd($value);
        if (!isnull($value)) {
            $this->scan = $value;
        }
    }

    public function updatedScan()
    {
        dd('123');
        // $is_checkIn = null;
        // $is_checkIn = Presensi::where('user_id', auth()->user()->id)->whereDate('check_in', '2024-02-22')->first();
        // if ($is_checkIn == null) {
        //     $data = new Presensi;
        //     $data->user_id = auth()->user()->id;
        //     $data->check_in = $this->scan;
        //     $data->save();
        // } else {
        //     $data = Presensi::where('user_id', auth()->user()->id)->whereDate('check_in', '2024-02-22')->first();
        //     $data->user_id = auth()->user()->id;
        //     $data->check_out = $this->scan;
        //     $data->save();
        // }
    }

    public function mount()
    {
        $this->scan = "";
    }
    public function render()
    {
        // $date = Carbon::now()->toDateString();
        // $time = Carbon::now()->toTimeString();
        $data = Presensi::where('user_id', auth()->user()->id)->whereDate('check_in', '2024-02-28')->first();
        $date_check_in = '';
        $time_check_in = '';
        $location_check_in = '';
        if ($data) {
            $date_check_in = Carbon::parse($data->check_in)->toDateString();
            $time_check_in = Carbon::parse($data->check_in)->toTimeString();
            $location_data = Location::find($data->location_id);
            $location_check_in = $location_data->location;
        }

        return view('livewire.scan', [
            'data' => $data,
            'date_check_in' => $date_check_in,
            'time_check_in' => $time_check_in,
            'location_check_in' => $location_check_in
        ]);
    }
}
