<?php 
$currentDateTime = date('Y-m-d H:i:s');

include 'config.php';

if(isset($_POST['m_upload'])){

   
    $rename_img = $_POST['mobile_name'];

    $imgFile = $_FILES['mobile_image']['name'];
    $imgSize = $_FILES['mobile_image']['size'];
    $tmp_dir = $_FILES['mobile_image']['tmp_name'];
    
    
        $upload_dir = 'uploads/'; // upload directory
    
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
    
        // rename uploading image
        $pic = $rename_img.".".$imgExt;
            
        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){           
            // Check file size '5MB'
            if($imgSize < 5000000)              {
                move_uploaded_file($tmp_dir,$upload_dir.$pic);
            }
            else{
                $errMSG = "Sorry, your file is too large.";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG files are allowed.";        
        }

        $add = "INSERT into tbl_image SET
        image_name = '". mysqli_real_escape_string($conn,$_POST['mobile_name']) ."',
        image_upload = '".$pic."',
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