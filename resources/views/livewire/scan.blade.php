<div class="flex justify-center flex-col w-1/4 mx-auto gap-5 mt-5">
    <h1 class="text-center">Please Activate your camera to start scanning!!</h1>

    <button id="scanButton" class="bg-blue-500 text-white px-3 py-2 rounded shadow">Scan QR Code</button>
    <input type="text" wire:model.live='scan'>
    <button class="btn btn-primary ">Scan QR Code</button>
    <p>{{ $scan }}</p>

    <div id="reader" width="600px"></div>


    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            alert(`Code matched = ${decodedText}`, decodedResult);
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

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
    </script>
</div>
