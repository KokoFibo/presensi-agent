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

        return view('scan', [
            'data' => $data,
            'date_check_in' => $date_check_in,
            'time_check_in' => $time_check_in,
            'location_check_in' => $location_check_in,

        ]);
    }


    public function processQRCode(Request $request)
    {

        $msg = 'ok';
        $msg_type = 'success';
        $string = [];
        $string = explode(',', $request->scanResult);
        $check_data = Presensi::where('check_in', $string[1])->first();

        if ($check_data == null) {
            $data = new Presensi;
            $data->user_id = auth()->user()->id;
            $data->location_id = $string[0];
            $data->check_in = $string[1];
            $data->save();
            $qrCodeData = $request->input('qr_code_data');
            $msg = 'Scanned Already';
            $msg_type = 'error';
        }


        // return response()->json(['success' => true, 'qr_code_data' => $qrCodeData]);
        // return back()->with(array('msg' => $msg, 'msg_type' => $msg_type));
        return Redirect::back()->with(['msg' => $msg]);
    }
}
