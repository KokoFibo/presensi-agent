<div class="flex justify-center flex-col w-1/4 mx-auto gap-5 mt-5">
    <h1 class="text-center">Please Activate your camera to start scanning!!</h1>

    <button id="scanButton" class="bg-blue-500 text-white px-3 py-2 rounded shadow">Scan QR Code</button>
    <input type="text" wire:model.live='scan'>

    <p>{{ $scan }}</p>

    <script>
        document.getElementById('scanButton').addEventListener('click', function() {
            // Start QR code scanning
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: document.querySelector('#scanner-container'),
                    constraints: {
                        width: 480,
                        height: 320,
                        facingMode: "environment" // or "user" for front camera
                    },
                },
                decoder: {
                    readers: ["code_128_reader"] // You can specify different barcode formats
                }
            }, function(err) {
                if (err) {
                    console.error(err);
                    return;
                }
                Quagga.start();
            });

            Quagga.onDetected(function(data) {
                var qrCodeData = data.codeResult.code;
                // Send the QR code data to the server via AJAX
                // Example AJAX request to send the QR code data to a Laravel route
                fetch('/process-qr-code', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if using Laravel CSRF protection
                        },
                        body: JSON.stringify({
                            qr_code_data: qrCodeData
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Handle response from the server
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('There was a problem with your fetch operation:', error);
                    });
            });
        });
    </script>
</div>
