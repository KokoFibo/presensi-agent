<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Location;
use App\Models\Presensi;
use Livewire\Attributes\On;

class Scan2 extends Component
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
        $now = Carbon::parse(Carbon::now())->toDateString();
        $is_checkedIn = false;
        $is_checkedOut = false;
        $durasiAbsen = 0;
        $check_in_out = 'Check In';


        $data = Presensi::where('user_id', auth()->user()->id)->whereDate('check_in', $now)->first();
        $date_check_in = '';
        $time_check_in = '';
        $date_check_out = '';
        $time_check_out = '';
        $location_check_in = '';
        $location_check_out = '';
        if ($data) {
            $date_check_in = Carbon::parse($data->check_in)->toDateString();
            $time_check_in = Carbon::parse($data->check_in)->toTimeString();
            $date_check_out = Carbon::parse($data->check_out)->toDateString();
            $time_check_out = Carbon::parse($data->check_out)->toTimeString();
            $location_data = Location::find($data->location_id);

            // $location_check_in = $location_data->location;
            // $location_check_out = $location_data->location;
            $location_check_in = $data->location_id;
            $location_check_out = $data->location_id;
            $durasi = $this->durasiCheckedIn($data->created_at);

        } else {
            $durasi = 0;
        }
        $sekarang = Carbon::now();



        if ($data) {
            $is_checkedIn = true;
            $check_in_out = "Check Out";
            if ($data->check_out != '') {
                $is_checkedOut = true;
                $durasiAbsen = durasiAbsen($data->check_in, $data->check_out);
            } else $is_checkedOut = false;
        } else {
            $is_checkedIn = false;
        }




        return view('livewire.scan2', [
            'data' => $data,
            'date_check_in' => $date_check_in,
            'time_check_in' => $time_check_in,
            'location_check_in' => $location_check_in,
            'date_check_out' => $date_check_out,
            'time_check_out' => $time_check_out,
            'location_check_out' => $location_check_out,
            'durasi' => $durasi,
            'sekarang' => $sekarang,
            'is_checkedIn' => $is_checkedIn,
            'is_checkedOut' => $is_checkedOut,
            'durasiAbsen' => $durasiAbsen,
            'check_in_out' => $check_in_out,
        ]);
    }
}
