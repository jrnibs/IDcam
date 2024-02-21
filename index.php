<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
</head>
<style>
.hidden {
        display: none;
    }

</style>
<body>
<?php 
// Check if the "mobile" word exists in User-Agent 
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 

if($isMob){ ?>

    <div class="container-fluid" >
        <div class="d-flex justify-content-center align-items-center " style="height: 80vh;">
            <div class="card card-shadow">
                <div class="card-header">
                    
                </div>
                <div class="card-body text-center">
                    <form action="m_upload.php" method="post" enctype="multipart/form-data">
                    <h3 class="p-2">Upload your picture</h3>
                    <img id="mobile_preview" class="hidden img-thumbnail my-2" src="" alt="Preview" style="max-width: 100%;">
                    <br>
                    <input type="file" id="mobile_image" name="mobile_image" capture="user" accept="uploads/*"  required>
                    <br>
                    <br>
                    <input type="text" class="form-control" placeholder="Rename the picture" name="mobile_name" required>
                    <br>
                    <button class="btn-submit" name="m_upload">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php
}else{  ?>

    <div class="container-fluid" >
        <div class="d-flex justify-content-center" style="height: 80vh;">
            <form method="post" action="w_upload.php">
            <div class="card card-shadow mt-5 px-3">
                <div class="row">
                    <div class="col">

                            <div class="card-body text-center">
                                <h1 class="mt-5">Capture</h1>
                            
                                <div id="my_camera"></div>
                                <br>
                                <input type="button" class="btn-design" value="Take Snapshot" onclick="take_Snapshot()">
                        
                            </div>

                    </div>

                    <div class="col">
                        
                            
                            <div class="card-body text-center">
                                <h1 class="mt-5">Preview</h1>
                                <input type="hidden" name="web_image" class="image-tag">
                                <br>
                                <input type="text" class="form-control text-center" placeholder="Rename the picture" name="web_name" required>
                                <br>
                                <div id="my_result">
                                    <h1 class="display-6 my-5">Your capture will appear here</h1>
                                    
                                </div>
                                <br>
                                <button class="btn-submit" name="w_upload">Submit</button>
                        
                            </div>
                       

                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>

    <script>
    Webcam.set({
        // live preview size
        width: 640,
        height: 480,

        // device capture size
        dest_width: 640,
        dest_height: 480,

        // final cropped size
		crop_width: 480,
		crop_height: 480,

        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false,
        flip_horiz: true,
        fps: 24
    });

    Webcam.attach("#my_camera");

    function take_Snapshot() {
        Webcam.snap(function (data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById("my_result").innerHTML = '<img src="' + data_uri + '"/>';
        });
    }

</script>
   
<?php }
?>

</body>
<script>
    
    // Add preview for mobile image upload
    $(document).ready(function() {
    $('#mobile_image').change(function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = new Image();
            img.src = event.target.result;
            $('#mobile_preview').attr('src', event.target.result);
            $('#mobile_preview').removeClass('hidden');
        };
        reader.readAsDataURL(file);
    });
});
</script>


</html>