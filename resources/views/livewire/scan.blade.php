<div class="flex flex-col justify-center gap-5 p-3 mx-auto mt-5 xl:w-1/4">

    <div id="reader" width="600px"></div>


    @if ($data == null || $durasi >= 1)


        @if (!$is_checkedOut)
            <button class="px-3 py-2 text-white bg-blue-500" onclick="startScan()">Please Scan QR to
                {{ $check_in_out }}</button>
            <form action="/process-qr-code" method="POST" id="form">
                @csrf
                <input type="hidden" wire:model.live="scan" id="scanResult" name="scanResult">
            </form>
        @endif
    @endif


    @if ($data != null)
        <div>
            @if ($is_checkedIn && $is_checkedOut == false)
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">

                    <h4 class="mb-4 text-lg font-semibold">Checked In</h4>

                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="font-semibold">Date</td>

                                <td>{{ $date_check_in }}</td>

                            </tr>
                            <tr>
                                <td class="font-semibold">Time</td>
                                <td>{{ $time_check_in }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Location</td>
                                <td>
                                    <p>{{ $location_check_in }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Duration</td>
                                <td>{{ $durasi }} minutes</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            @endif

            @if ($is_checkedIn && $is_checkedOut == true)
                <div class="p-4 bg-gray-100 rounded-lg shadow-md">

                    <h4 class="mb-4 text-lg font-semibold">Checked Out</h4>

                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="font-semibold">Date</td>

                                <td>{{ $date_check_out }}</td>

                            </tr>
                            <tr>
                                <td class="font-semibold">Time</td>
                                <td>{{ $time_check_out }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Location</td>
                                <td>
                                    <p>{{ $location_check_out }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Duration</td>
                                <td>{{ $durasiAbsen }} minutes</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    @endif


    @section('script')
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

        <script>
            function test() {

                document.getElementById('scanResult').value = '1,2024-02-28 07:43:50';
                document.getElementById('form').submit();
            }

            // function onScanSuccess(decodedText, decodedResult) {

            //     document.getElementById('scanResult').value = decodedText;
            //     document.getElementById('form').submit();

            //     html5QrcodeScanner.clear();
            // }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
                // for example:
                console.warn(`Code scan error = ${error}`);
            }

            function startScan() {

                const html5QrCode = new Html5Qrcode("reader");
                const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                    document.getElementById('scanResult').value = decodedText;
                    document.getElementById('form').submit();
                    // stop camera from scanning
                    html5QrCode.stop().then((ignore) => {
                        // QR Code scanning is stopped.
                    }).catch((err) => {
                        // Stop failed, handle it.
                    });
                };
                const config = {
                    fps: 10,
                    qrbox: {
                        width: 350,
                        height: 350
                    }
                };

                // If you want to prefer front camera
                // html5QrCode.start({
                //     facingMode: "user"
                // }, config, qrCodeSuccessCallback);

                // If you want to prefer back camera
                html5QrCode.start({
                    facingMode: "environment"
                }, config, qrCodeSuccessCallback);
            }
        </script>
    @endsection







</div>
