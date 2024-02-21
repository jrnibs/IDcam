<?php 
$currentDateTime = date('Y-m-d H:i:s');

include 'config.php';

if(isset($_POST['w_upload'])){

    $img = $_POST['web_image'];
    $name = $_POST['web_name'];
    
    $folderPath = "uploads/";
    
    $image_parts = explode(";base64,", $img);
    
    $image_type_aux = explode("image/", $image_parts[0]);
    
    $image_type = $image_type_aux[1];
    
    $image_base64 = base64_decode($image_parts[1]);
    
    $filename = $name . '.jpg';
    
    $file = $folderPath . $filename;
    
    file_put_contents($file,$image_base64);

    $add = "INSERT into tbl_image SET
    image_name = '". mysqli_real_escape_string($conn,$_POST['web_name']) ."',
    image_upload = '".$filename."',
    active = '1',
    date_created = '". $currentDateTime ."'";


   if($result = mysqli_query($conn,$add)){

         ?>
            <script>
            alert('Successfully Uploaded');
            window.location.href ='index.php';
            </script>
            <?php
   } else {

        if(!$result) {die('Unsuccessfull uploaded'. mysqli_error()); } 

   }

   mysqli_close($conn);


} else {

    ?>
    <script>
    alert('Please try to upload again');
    window.location.href ='index.php';
    </script>
    <?php
}



?>