<div class="flex justify-center flex-col p-3 xl-w-1/4 mx-auto gap-5 mt-5">
    <h1 class="text-center">Please Activate your camera to start scanning!!</h1>

    <button class="bg-blue-500 text-white px-3 py-2" @click="startScan()">Scan QR Code ini</button>
    <input type="text" wire:model.live='scan'>


    <div id="reader" width="600px"></div>


    @section('script')
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                // handle the scanned code as you like, for example:
                console.log(`Code matched = ${decodedText}`, decodedResult);
                html5QrcodeScanner.clear();
                // alert(`Code matched = ${decodedText}`, decodedResult);
                alert(decodedText);
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
    @endsection

</div>
