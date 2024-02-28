<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function processQRCode(Request $request)
    {
        $string = [];
        $string = explode(',', $request->scanResult);
        $data = new Presensi;
        $data->user_id = auth()->user()->id;
        $data->location_id = $string[0];
        $data->check_in = $string[1];
        $data->save();
        $qrCodeData = $request->input('qr_code_data');


        // return response()->json(['success' => true, 'qr_code_data' => $qrCodeData]);
        return back();
    }
}
