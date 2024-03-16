<!DOCTYPE html>
<html>

<head>
    <title>Instascan</title>
    <script type="text/javascript" src="instascan.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>

<body>
    
    <video id="preview"></video>

    <button onclick="scanqr()" class="px-3 py-2 text-white bg-blue-500">Scan QR mantab</button>
    <div>
        hasil: 
    </div>
    <div id="result"></div>


    <script type="text/javascript">

    function scanqr() {
        
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
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
            document.getElementById('result').innerHTML = content;

            console.log(content);
        });
    }
    </script>
</body>

</html>
