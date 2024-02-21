<?php 
$currentDateTime = date('Y-m-d H:i:s');

include 'config.php';

if(isset($_GET['del'])){

    $image_id = $_GET['del'];
    
    //delete image from database

    $sql = "SELECT * FROM tbl_image WHERE id = '$image_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $filename = $row['image_upload'];
    }

    if(isset($filename)){
        unlink("uploads/".$filename);

        $sql2 = "DELETE FROM tbl_image WHERE id='$image_id' ";
        if (mysqli_query($conn, $sql2)) {
    
            echo "<script>alert('Image has been deleted');
            window.location.href ='list.php';</script>";

    
        } else {
                echo "Error deleting record: " . mysqli_error($conn);
        }

    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

   

   
}