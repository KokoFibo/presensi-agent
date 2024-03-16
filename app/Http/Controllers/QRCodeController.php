<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Location;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QRCodeController extends Controller
{
    public function index()
    {
        $data = Presensi::where('user_id', auth()->user()->id)->whereDate('check_in', Carbon::parse(now())->toDateString())->first();
        $date_check_in = '';
        $time_check_in = '';
        $location_check_in = '';
        if ($data) {
            $date_check_in = Carbon::parse($data->check_in)->toDateString();
            $time_check_in = Carbon::parse($data->check_in)->toTimeString();
            $location_data = Location::find($data->location_id);
            $location_check_in = $location_data->location;
        }
        return view('scan', [
            'data' => $data,
            'date_check_in' => $date_check_in,
            'time_check_in' => $time_check_in,
            'location_check_in' => $location_check_in,
        ]);
    }


    public function processQRCode(Request $request)
    {
        dd('ok');
        $now = Carbon::parse(Carbon::now())->toDateString();
        $msg = 'ok';
        $msg_type = 'success';
        $string = [];
        $string = explode(',', $request->scanResult);
        if (count($string) != 2) {

            return Redirect::back()->with(['msg' => 'Wrong Barcode']);
        } else if (Carbon::parse($string[1])->toDateString() != $now) {
            // dd('Barcode Expired');
            return Redirect::back()->with(['msg' => 'Barcode Expired']);
        }


        $check_data = Presensi::whereDate('created_at', $now)->where('check_in', '!=', '')->where('user_id', auth()->user()->id)->first();
        if ($check_data) {
            if (Presensi::whereDate('created_at', $now)->where('check_in', '!=', '')->where('check_out', '!=', '')->where('user_id', auth()->user()->id)->first()) {
                dd('scan in dan out');
                return  Redirect::back()->with(['msg' => 'sdh scan in dan out']);
            }
        }

        if ($check_data == null) {
            $data = new Presensi;
            $data->user_id = auth()->user()->id;
            $data->location_id = $string[0];
            $data->check_in = $string[1];
            $data->save();
            $qrCodeData = $request->input('qr_code_data');
            $msg = 'Scanned Already';
            $msg_type = 'error';
        } else {
            $data = Presensi::find($check_data->id);
            $data->user_id = auth()->user()->id;
            $data->location_id = $string[0];
            $data->check_out = $string[1];
            $data->save();
            $qrCodeData = $request->input('qr_code_data');
            $msg = 'Check_out  Already';
            $msg_type = 'error';
        }
        return Redirect::back()->with(['msg' => $msg]);
    }
}
