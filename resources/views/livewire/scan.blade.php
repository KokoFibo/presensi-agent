<div class="flex justify-center flex-col p-3 xl-w-1/4 mx-auto gap-5 mt-5">
    @if (isset($msg))
        @if ($msg_type == 'error')
            <div id="alert" class="alert alert-danger" role="alert">{{ $msg }}</div>
        @else
            <div id="alert" class="alert alert-success" role="alert">{{ $msg }}</div>
        @endif
        <script>
            setTimeout("document.getElementById('mensajecarrito').style.display='none'", 6000);
        </script>
    @endif
    <h1 class="text-center">Please Activate your camera to start scanning!!</h1>

    <button class="bg-blue-500 text-white px-3 py-2" @click="startScan()">Scan QR Code ini</button>
    <form action="/process-qr-code" method="POST" id="form">
        @csrf
        <input type="hidden" wire:model.live="scan" id="scanResult" name="scanResult">
    </form>
    @if ($data != null)
        <div>
            <h4>Checked in</h4>
            <p>Date : {{ $date_check_in }}</p>
            <p>Time : {{ $time_check_in }}</p>
            <p>Location : {{ $location_check_in }}</p>
        </div>
    @endif


    <button @click="test">Test emit</button>

    <div id="reader" width="600px"></div>


    @section('script')
        {{-- @script --}}
        <script>
            function test() {
                document.getElementById('scanResult').value = '1,2024-02-28 07:43:47';
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
                let html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    /* verbose= */
                    false);
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            }
        </script>
        {{-- @endscript --}}
    @endsection

</div>
