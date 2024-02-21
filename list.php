<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css">

</head>
<style>


</style>
<body>

    <div class="container-fluid" >
        <div class="d-flex justify-content-center align-items-center " style="height: 80vh;">
            <div class="card card-shadow p-3" style="width: 80vw;">
                <div class="card-header">
                    <h3>Image List</h3>
                </div>
                <div class="card-body text-center">
                    <table class="table table-responsive-sm table-hover display nowrap" id="my_table" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Active</th>
                                <th>Date Updated</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT * FROM tbl_image";

                            $count = 1;
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['image_name']; ?></td>
                                <td><?php echo $row['image_upload']; ?></td>
                                <td class="text-center"><?php if($row['active']==1) {?>
                                    <span class="badge rounded-pill bg-success">Active</span>
                                    <?php } else {?>
                                    <span class="badge rounded-pill bg-secondary">Inactive</span>
                                    <?php } ?>
                                </td>
                                <td><?php echo $row['date_updated']; ?></td>
                                <td><?php echo $row['date_created']; ?></td>
                                <td><a href="delete.php?del=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete?');" >  <button class="btn btn-danger btn-sm">Delete</button></a></td>
                            </tr>
                            <?php } ?>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script>
$(document).ready(function() {
    $('#my_table').DataTable({
        responsive: true
    });
});
</script>


</html>