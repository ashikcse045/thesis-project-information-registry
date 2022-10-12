<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    require_once '../partials/db_connection.php';

    $ref_id = $_GET['id'];

    $sql = "select * from thesis_project_info where stu_id = '$ref_id'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) == 1)
    {
        $row = mysqli_fetch_array($query);
        
        $name = $row['stu_name'];
        $id = $row['stu_id'];
        $batch = $row['batch'];
        $semester = $row['semester'];
        $credit = $row['credit'];
        $title = $row['title'];

        $team_id = $row['team_id'];
   
    }

    if(isset($_POST['submit']))
    {
        $one_valid = true;
        
        $team_id = "cse_".rand(10000,99999);
        
        //member info check
        // NAME
        if(!empty($_POST['name']))
        {
            $name = $_POST['name'];

            // ID
            if(!empty($_POST['id']))
            {
                $id = $_POST['id'];

                // BATCH
                if(!empty($_POST['batch']))
                {
                    $batch = $_POST['batch'];

                    // SESMESTER
                    if(!empty($_POST['semester']))
                    {
                        $semester = $_POST['semester'];

                        // CREDIT
                        if(!empty($_POST['credit']))
                        {
                            $credit = $_POST['credit'];

                            // UPDATE QUERY
                            $sql = "UPDATE thesis_project_info
                                    SET
                                    stu_name = '$name',
                                    stu_id = '$id',
                                    batch = '$batch',
                                    semester = '$semester',
                                    credit = '$credit'
                                    WHERE
                                    stu_id = '$id'";
                            
                            if($query = mysqli_query($conn, $sql))
                            {
                                echo "<script>alert('record updated successfully')</script>";
                            }

                        }
                        else{
                            $one_valid = false;
                            $error = "* Please fill 1st member credit field";
                        }
                    }
                    else{
                        $one_valid = false;
                        $error = "* Please fill 1st member semester field";
                    }
                }
                else{
                    $one_valid = false;
                    $error = "* Please fill 1st member batch field";
                }
            }
            else{
                $one_valid = false;
                $error = "* Please fill 1st member id field";
            }
        }
        else{
            $one_valid = false;
            $error = "* Please fill 1st member name field";
        }
        
        // >>** SUBMIT THE FORM **<<
        

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit student info</title><link rel="icon" type="image/x-icon" href="../favicon.ico">

    
    <link rel="stylesheet" href="../fontawesome-6/css/all.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/supervisor.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
<?php require_once '../partials/nav.php' ?>
    <div class="container">
        <?php require_once 'sv_side_nav.php' ?>
        
        <div class="content">
            <div class="content_box">

                <div class="page_title">
                    <h1>edit student information</h1>
                </div>

                <div class="form_div">
                    <h4 style="margin-bottom: 15px; text-transform: capitalize;"><a href="edit_thesis_project_team.php?team=<?php echo $team_id ?>" style="text-decoration: none;">edit team info</a></h4>
                    
                    <div class="title" style="background-color: #395B64; color: #E7F6F2; padding: 10px; font-size: 14px; margin-bottom: 10px;">
                        <h2><?php echo $title ?></h2>
                    </div>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="members">
                            <div class="member_about">
                                <div class="nested_box">
                                    <label for="m1_name">name</label>
                                    <input type="text" name="name" id="m1_name" placeholder="name" value="<?php echo isset($name) ? $name : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_id">id</label>
                                    <input type="text" name="id" id="m1_id" placeholder="id" value="<?php echo isset($id) ? $id : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_batch">batch</label>
                                    <input type="text" name="batch" id="m1_batch" placeholder="batch" value="<?php echo isset($batch) ? $batch : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_sem">semester</label>
                                    <input type="text" name="semester" id="m1_sem" placeholder="semester" value="<?php echo isset($semester) ? $semester : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_credit">credit</label>
                                    <input type="text" name="credit" id="m1_credit" placeholder="credit" value="<?php echo isset($credit) ? $credit : '' ?>">
                                </div>
                        
                            </div>
                            <p class="error_msg"><?php echo isset($error) ? $error : '' ?></p>
                        </div>
        
                        
        
                        
        
                        <div class="fields">
                            <input type="submit" name="submit" id="submit" >
                            <br>
                            <a href="javascript:history.back()">Back to previous page</a>
                        </div>
        
        
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>