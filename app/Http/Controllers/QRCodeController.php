<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function processQRCode(Request $request)
    {
        $qrCodeData = $request->input('qr_code_data');

        // Process the QR code data

        dd($qrCodeData);
        return response()->json(['success' => true, 'qr_code_data' => $qrCodeData]);
    }
}
