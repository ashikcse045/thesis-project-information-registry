<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    require_once '../partials/db_connection.php';

    if(isset($_POST['view']))
    {
        $old_file = $_POST['file'];
        $file = '../uploads/'.$old_file;
        $filename = $old_file;
        header('Content-type: application/pdf');
        @readfile($file);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin All List</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    
    <link rel="stylesheet" href="../fontawesome-6/css/all.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/admin_all_list.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

</head>
<body>
    
    <?php require_once '../partials/nav.php' ?>

    <div class="container">
        
        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">

                <div class="page_title">
                    <h1>all list</h1>
                </div>

                <div class="list_content">
                    
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>student id</th>
                                <th>student name</th>
                                <th>title</th>
                                <th>batch</th>
                                <th>semester</th>
                                <th>exam session</th>
                                <th>catagory</th>
                                <th>upload date</th>
                                <th>supervisor name</th>
                                <th>action</th>
                                <!-- <th>delete</th> -->
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                                <th>student id</th>
                                <th>student name</th>
                                <th>title</th>
                                <th>batch</th>
                                <th>semester</th>
                                <th>exam session</th>
                                <th>catagory</th>
                                <th>upload date</th>
                                <th>supervisor name</th>
                                <th>action</th>
                                <!-- <th>delete</th> -->
                            </tr>
                        </tfoot>

                        <tbody>
                        <?php
                                $sql = "SELECT * FROM thesis_project_info tp inner join sv_table sv on tp.sv_ref = sv.sv_email";
                                // echo $sv_uid;
                                $query = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($query) > 0)
                                {
                                    while($row = mysqli_fetch_array($query))
                                    {
                                        ?>
                                        
                                            <tr>
                                                <td><?php echo $row['stu_id'] ?></td>
                                                <td><?php echo $row['stu_name'] ?></td>
                                                
                                                
                                                <td>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="file" value="<?php echo $row['report'] ?>">
                                                        <button name="view" style="padding: 10px 15px; cursor: pointer; border: none;">
                                                            <?php echo $row['title'] ?>
                                                        </button>
                                                    </form>
                                                </td>

                                                <!-- <td><?php echo $row['title'] ?></td> -->
                                                <td><?php echo $row['batch'] ?></td>
                                                <td><?php echo $row['semester'] ?></td>
                                                <td><?php echo $row['end_session'] ?></td>
                                                <td><?php echo $row['catagory'] ?></td>
                                                <td><?php echo $row['upload_date'] ?></td>
                                                <td><?php echo $row['sv_name'] ?></td>
                                                <td style="box-sizing: border-box">
                                                    <a href="update_student.php?id=<?php echo $row['stu_id'] ?>" style="display: block; box-sizing: border-box; text-decoration: none; padding:5px; background-color: #395B64;; color: #E7F6F2; margin-bottom: 2px;">update</a>
                                                    <a href="#" style="display: block; box-sizing: border-box; text-decoration: none; padding:5px; background-color: red; color: #E7F6F2;">delete</a>
                                                </td>
                                                <!-- <td>
                                                    <a href="#" style="text-decoration: none; padding:5px; background-color: red; color: #E7F6F2;">delete</a>
                                                </td> -->
                                            </tr>
                                            
                                        

                                        <?php
                                    }
                                    
                                }
                            ?>
                    
                        </tbody>
                    </table>

                </div>
            </div>
            
        </div>
    </div>
    
    <?php require_once '../partials/footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    
    <script>
        $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
    } );
    </script>
</body>
</html>