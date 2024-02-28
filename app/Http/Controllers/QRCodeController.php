<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function processQRCode(Request $request)
    {
        $data = new Presensi;
        $data->user_id = auth()->user()->id;
        $data->check_in = $request->scanResult;
        $data->save();
        $qrCodeData = $request->input('qr_code_data');


        return response()->json(['success' => true, 'qr_code_data' => $qrCodeData]);
    }
}
