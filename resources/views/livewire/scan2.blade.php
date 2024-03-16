<div class="flex flex-col justify-center gap-5 p-3 mx-auto mt-5 xl:w-1/4">
    <video id="preview"></video>

    @if ($data == null || $durasi >= 2)
        <h1 class="text-center">Please Activate your camera to start scanning!!</h1>
        <p>Check in : {{ $is_checkedIn }}, Check out: {{ $is_checkedOut }}</p>
        @if (!$is_checkedOut)
            <button class="px-3 py-2 text-white bg-blue-500" onclick="startScan()">Scan QR to {{ $check_in_out }}</button>
            <form action="/process-qr-code" method="POST" id="form">
                @csrf
                <input type="hidden" wire:model.live="scan" id="scanResult" name="scanResult">
            </form>
        @endif
    @endif


    @if ($data != null)
        <div>
            @if ($is_checkedIn && $is_checkedOut == false)
                <h4>Checked In</h4>
                <p>Date : {{ $date_check_in }}</p>
                <p>Time : {{ $time_check_in }}</p>
                <p>Location : {{ $location_check_in }}</p>
        <p>Durasi: {{ $durasi }} minutes</p>

            @endif

            @if ($is_checkedIn && $is_checkedOut == true)
                <h4>Checked Out</h4>
                <p>Date : {{ $date_check_out }}</p>
                <p>Time : {{ $time_check_out }}</p>
                <p>Location : {{ $location_check_out }}</p>
        <p>Durasi Absen: {{ $durasiAbsen }} minutes</p>

            @endif

        </div>
    @endif
    <div>
        
    </div>
    <div id="result"></div>




    <script type="text/javascript"></script>
    @section('script')
        <script type="text/javascript" src="instascan.min.js"></script>
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
                video: document.getElementById('preview')
            });
            scanner.addListener('scan', function(content) {
                console.log(content);
                document.getElementById('result').innerHTML = content;
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
