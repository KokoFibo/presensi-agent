<div class="flex flex-col justify-center gap-5 p-3 mx-auto mt-5 xl:w-1/4">
    <video id="preview"></video>


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





    <script type="text/javascript"></script>
    @section('script')
        {{-- <script type="text/javascript" src="instascan.min.js"></script> --}}
        {{-- <script type="text/javascript" src="{{ asset('/public/instascan.min.js') }}"></script> --}}

        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    @endsection
    <script>
        function startScan() {
            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[2]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });

            let scanner = new Instascan.Scanner({
                video: document.getElementById('preview'),
                mirror: false
            });

            scanner.addListener('scan', function(content) {
                console.log('ok');
                console.log(content);
                document.getElementById('scanResult').value = content;
                document.getElementById('form').submit();
                if (content != '') {

                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) {
                            scanner.stop(cameras[2]);
                        } else {
                            console.error('No cameras found.');
                        }
                    }).catch(function(e) {
                        console.error(e);
                    });
                    console.log('scanner stop');
                }
            });
        }
    </script>

</div>
