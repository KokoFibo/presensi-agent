<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Location;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQr extends Component
{
    public $string, $formattedString;

    public function mount()
    {
        $this->string = 'Welcome';
    }
    public function generate()
    {
        $mytime = Carbon::now();
        $this->string = auth()->user()->location_id . ',' . $mytime->toDateTimeString();
        // $this->formattedString = $mytime->toDateTimeString();
        // $this->formattedString = $mytime->toDayDateTimeString();

        // $this->formattedString = date('d-M-Y', strtotime($this->string));
        // $this->formattedString = time('H:i:s', strtotime($this->string));
    }
    public function render()
    {

        $qrcode = QrCode::size(300)->generate($this->string);
        return view('livewire.generate-qr', [
            'qrcode' => $qrcode
        ]);
    }
}
