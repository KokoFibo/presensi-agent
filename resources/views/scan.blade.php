@extends('layouts.app1')
@section('main')
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="flex flex-col justify-center gap-5 p-3 mx-auto mt-5 xl-w-1/4">


        <h1 class="text-center">Please Activate your camera to start scanning !</h1>

        <button class="px-3 py-2 text-white bg-blue-500" @click="startScan()">Scan QR Code ini</button>
        <form action="/process-qr-code" method="POST" id="form">
            @csrf
            <input type="hidden" wire:model.live="scan" id="scanResult" name="scanResult">
        </form>
        @if ($data != null)
            <div class="mx-auto lg:w-1/5">
                <h4>Checked in</h4>
                <p>Date : {{ $date_check_in }}</p>
                <p>Time : {{ $time_check_in }}</p>
                <p>Location : {{ $location_check_in }}</p>
            </div>
        @endif


        {{-- <button @click="test()" class="btn btn-primary">Test emit</button> --}}

        <div id="reader" width="600px"></div>
        @if (Session::has('msg'))
            <div role="alert" class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-current shrink-0" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Data already Scanned</span>
            </div>
        @endif

    </div>
    {{-- @endsection --}}


@section('script')
    <script>
        function test() {
            document.getElementById('scanResult').value = '1,2024-02-28 07:43:50';
            document.getElementById('form').submit();
        }

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            // alert(`Code matched = ${decodedText}`, decodedResult);
            // alert(decodedText);
            document.getElementById('scanResult').value = decodedText;
            document.getElementById('form').submit();
            // $wire.on('getScanResult', decodedText);
            html5QrcodeScanner.clear();
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }



        function startScan() {
            const html5QrCode = new Html5Qrcode("reader");
            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                /* handle success */
            };
            const config = {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            };

            // If you want to prefer back camera
            html5QrCode.start({
                facingMode: "environment"
            }, config, qrCodeSuccessCallback);
        }
    </script>
@endsection
@endsection
