<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    require_once '../partials/db_connection.php';

    $today = date("Y-m-d");
    $sv_uid = $_SESSION['sv_id'];
    // $sql = "select id from sv_table where email='$uid'";
    // $query = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_array($query);
    $sv_ref = $sv_uid;

    $team = $_GET['team'];

    $sql = "select * from thesis_project_info where team_id = '$team'";
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) > 0)
    {
        // $row = mysqli_fetch_array($query);
        $name = array();
        $id = array();
        $batch = array();
        $credit = array();
        $semester = array();

        while($row = mysqli_fetch_array($query))
        {
            $title = $row['title'];
            $catagory = $row['catagory'];
            $st_session = $row['st_session'];
            $end_session = $row['end_session'];
            $old_file = $row['report'];

            array_push($name, $row['stu_name']);
            array_push($id, $row['stu_id']);
            array_push($batch, $row['batch']);
            array_push($credit, $row['credit']);
            array_push($semester, $row['semester']);
        }
        
        
        $st = explode("-", $st_session);
        $s_sName = $st[0];
        $s_sYear = $st[1];

        $end = explode("-", $end_session);
        $e_sName = $end[0];
        $e_sYear = $end[1];  

        $count = mysqli_num_rows($query);
        if($count === 1)
        {
            $m1_name = $name[0];
            $m1_id = $id[0];
            $m1_batch = $batch[0];
            $m1_credit = $credit[0];
            $m1_semester = $semester[0];

            $id1 = $id[0];
        }
        else if($count === 2)
        {
            $m1_name = $name[0];
            $m1_id = $id[0];
            $m1_batch = $batch[0];
            $m1_credit = $credit[0];
            $m1_semester = $semester[0];
            $id1 = $id[0];
            
            $m2_name = $name[1];
            $m2_id = $id[1];
            $m2_batch = $batch[1];
            $m2_credit = $credit[1];
            $m2_semester = $semester[1];
            $id2 = $id[1];
        }
        else if($count === 3)
        {
            $m1_name = $name[0];
            $m1_id = $id[0];
            $m1_batch = $batch[0];
            $m1_credit = $credit[0];
            $m1_semester = $semester[0];
            $id1 = $id[0];
            
            $m2_name = $name[1];
            $m2_id = $id[1];
            $m2_batch = $batch[1];
            $m2_credit = $credit[1];
            $m2_semester = $semester[1];
            $id2 = $id[1];

            $m3_name = $name[2];
            $m3_id = $id[2];
            $m3_batch = $batch[2];
            $m3_credit = $credit[2];
            $m3_semester = $semester[2];
            $id3 = $id[2];
        }
       
    }

    if(isset($_POST['view']))
    {
        $file = '../uploads/'.$old_file;
        $filename = $old_file;
        header('Content-type: application/pdf');
        // header('Content-Disposition: inline; filename="' . $filename . '"');
        // header('Content-Transfer-Encoding: binary');
        // header('Content-Length: ' . filesize($file));
        // header('Accept-Ranges: bytes');
        @readfile($file);
    }

    if(isset($_POST['submit']))
    {
        $one_valid = true;
        $two_valid = true;
        $all_valid = true;

        // $_POST = array();
        // title check 
        if(!empty($_POST['title']))
        {
            $title = htmlspecialchars($_POST['title']);

        }
        else{
            $one_valid = false;
            $title_error = "* Please fill title field";
        }

        // catagory check 
        if(!empty($_POST['catagory']))
        {
            $catagory = $_POST['catagory'];
        }
        else{
            $one_valid = false;
            $cat_error = "* please fill catagory field";
        }

        // 1st member info check
        // NAME
        if(!empty($_POST['1_name']))
        {
            $m1_name = $_POST['1_name'];

            // ID
            if(!empty($_POST['1_id']))
            {
                $m1_id = $_POST['1_id'];

                // BATCH
                if(!empty($_POST['1_batch']))
                {
                    $m1_batch = $_POST['1_batch'];

                    // SESMESTER
                    if(!empty($_POST['1_semester']))
                    {
                        $m1_semester = $_POST['1_semester'];

                        // CREDIT
                        if(!empty($_POST['1_credit']))
                        {
                            $m1_credit = $_POST['1_credit'];
                        }
                        else{
                            $one_valid = false;
                            $m1_error = "* Please fill 1st member credit field";
                        }
                    }
                    else{
                        $one_valid = false;
                        $m1_error = "* Please fill 1st member semester field";
                    }
                }
                else{
                    $one_valid = false;
                    $m1_error = "* Please fill 1st member batch field";
                }
            }
            else{
                $one_valid = false;
                $m1_error = "* Please fill 1st member id field";
            }
        }
        else{
            $one_valid = false;
            $m1_error = "* Please fill 1st member name field";
        }

        // 2nd member info check
        // NAME
        if(!empty($_POST['2_name']))
        {
            $m2_name = $_POST['2_name'];

            // ID
            if(!empty($_POST['2_id']))
            {
                $m2_id = $_POST['2_id'];

                // BATCH
                if(!empty($_POST['2_batch']))
                {
                    $m2_batch = $_POST['2_batch'];

                    // SESMESTER
                    if(!empty($_POST['2_semester']))
                    {
                        $m2_semester = $_POST['2_semester'];

                        // CREDIT
                        if(!empty($_POST['2_credit']))
                        {
                            $m2_credit = $_POST['2_credit'];
                        }
                        else{
                            $two_valid = false;
                            $m2_error = "* Please fill 2nd member credit field";
                        }
                    }
                    else{
                        $two_valid = false;
                        $m2_error = "* Please fill 2nd member semester field";
                    }
                }
                else{
                    $two_valid = false;
                    $m2_error = "* Please fill 2nd member batch field";
                }
            }
            else{
                $two_valid = false;
                $m2_error = "* Please fill 2nd member id field";
            }
        }
        else{
            $two_valid = false;
            $m2_error = "* Please fill 2nd member name field";
        }

        // 3rd member info check
        // NAME
        if(!empty($_POST['3_name']))
        {
            $m3_name = $_POST['3_name'];

            // ID
            if(!empty($_POST['3_id']))
            {
                $m3_id = $_POST['3_id'];

                // BATCH
                if(!empty($_POST['3_batch']))
                {
                    $m3_batch = $_POST['3_batch'];

                    // SESMESTER
                    if(!empty($_POST['3_semester']))
                    {
                        $m3_semester = $_POST['3_semester'];

                        // CREDIT
                        if(!empty($_POST['3_credit']))
                        {
                            $m3_credit = $_POST['3_credit'];
                        }
                        else{
                            $all_valid = false;
                            $m3_error = "* Please fill 3rd member credit field";
                        }
                    }
                    else{
                        $all_valid = false;
                        $m3_error = "* Please fill 3rd member semester field";
                    }
                }
                else{
                    $all_valid = false;
                    $m3_error = "* Please fill 3rd member batch field";
                }
            }
            else{
                $all_valid = false;
                $m3_error = "* Please fill 3rd member id field";
            }
        }
        else{
            $all_valid = false;
            $m3_error = "* Please fill 3rd member name field";
        }

        // session check 
        // STARTING SESSION
        // session name
        if(!empty($_POST['s_sName']))
        {
            $s_sName = $_POST['s_sName'];

            // session year
            if(!empty($_POST['s_sYear']))
            {
                $s_sYear = $_POST['s_sYear'];

                $st_session = $s_sName."-".$s_sYear;
            }
            else{
                $one_valid = false;
                $st_sess_error = "* please fill starting session year";
            }
        }
        else{
            $one_valid = false;
            $st_sess_error = "* please fill starting session name";
        }

        // ENDING SESSION
        // session name
        if(!empty($_POST['e_sName']))
        {
            $e_sName = $_POST['e_sName'];

            // session year
            if(!empty($_POST['e_sYear']))
            {
                $e_sYear = $_POST['e_sYear'];
                $end_session = $e_sName."-".$e_sYear;
            }
            else{
                $one_valid = false;
                $end_sess_error = "* please fill ending session year";
            }
        }
        else{
            $one_valid = false;
            $end_sess_error = "* please fill ending session name";
        }

        // FILE VALIDATION
        // >>** SUBMIT THE FORM **<<
        if(!empty($_FILES['file']['name']))
            {
                $upload_dir = "../uploads/";
                $file_name = basename($_FILES['file']['name']);
                $temp_name = $_FILES['file']['tmp_name'];
                $file_type = $_FILES['file']['type'];
                $file_size = $_FILES['file']['size'];
                $file_size = $file_size/(1024*1024);
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                $replace_name = $team.".".$ext;
                $target_dir = $upload_dir.$replace_name;
                // echo $replace_name;

                if($ext === 'pdf')
                {
                    if($file_size < 5)
                    {
                        if($all_valid && $two_valid && $one_valid)
                        {
                            //all
                            $sql = "UPDATE thesis_project_info
                                    SET
                                    stu_id = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_id'
                                                WHEN '$id2' THEN '$m2_id'
                                                WHEN '$id3' THEN '$m3_id'
                                                END),
                                    stu_name = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_name'
                                                WHEN '$id2' THEN '$m2_name'
                                                WHEN '$id3' THEN '$m3_name'
                                                END),
                                    batch = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_batch'
                                                WHEN '$id2' THEN '$m2_batch'
                                                WHEN '$id3' THEN '$m3_batch'
                                                END),
                                    semester = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_semester'
                                                WHEN '$id2' THEN '$m2_semester'
                                                WHEN '$id3' THEN '$m3_semester'
                                                END),
                                    credit = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_credit'
                                                WHEN '$id2' THEN '$m2_credit'
                                                WHEN '$id3' THEN '$m3_credit'
                                                END), 
                                    title = ( CASE stu_id
                                                WHEN '$id1' THEN '$title'
                                                WHEN '$id2' THEN '$title'
                                                WHEN '$id3' THEN '$title'
                                                END),
                                    catagory = ( CASE stu_id
                                                WHEN '$id1' THEN '$catagory'
                                                WHEN '$id2' THEN '$catagory'
                                                WHEN '$id3' THEN '$catagory'
                                                END),
                                    st_session = ( CASE stu_id
                                                WHEN '$id1' THEN '$st_session'
                                                WHEN '$id2' THEN '$st_session'
                                                WHEN '$id3' THEN '$st_session'
                                                END),
                                    end_session = ( CASE stu_id
                                                WHEN '$id1' THEN '$end_session'
                                                WHEN '$id2' THEN '$end_session'
                                                WHEN '$id3' THEN '$end_session'
                                                END),
                                    report = ( CASE stu_id
                                                WHEN '$id1' THEN '$replace_name'
                                                WHEN '$id2' THEN '$replace_name'
                                                WHEN '$id3' THEN '$replace_name'
                                                END)
                                    WHERE stu_id IN ('$id1', '$id2', '$id3') ";
                            

                            unlink('../uploads/'.$old_file);
                            if(mysqli_query($conn, $sql) && move_uploaded_file($temp_name, $target_dir))
                            {

                                echo "<script>alert('updated sucessfully')</script>";
                            }
                            else{
                                echo "<script>alert('error in query')</script>";
                            }

                        }
                        else if($two_valid && !isset($m3_name) && $one_valid)
                        {
                            // two
                            $sql = "UPDATE thesis_project_info
                                    SET
                                    stu_id = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_id'
                                                WHEN '$id2' THEN '$m2_id'
                                                END),
                                    stu_name = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_name'
                                                WHEN '$id2' THEN '$m2_name'
                                                END),
                                    batch = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_batch'
                                                WHEN '$id2' THEN '$m2_batch'
                                                END),
                                    semester = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_semester'
                                                WHEN '$id2' THEN '$m2_semester'
                                                END),
                                    credit = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_credit'
                                                WHEN '$id2' THEN '$m2_credit'
                                                END), 
                                    title = ( CASE stu_id
                                                WHEN '$id1' THEN '$title'
                                                WHEN '$id2' THEN '$title'
                                                END),
                                    catagory = ( CASE stu_id
                                                WHEN '$id1' THEN '$catagory'
                                                WHEN '$id2' THEN '$catagory'
                                                END),
                                    st_session = ( CASE stu_id
                                                WHEN '$id1' THEN '$st_session'
                                                WHEN '$id2' THEN '$st_session'
                                                END),
                                    end_session = ( CASE stu_id
                                                WHEN '$id1' THEN '$end_session'
                                                WHEN '$id2' THEN '$end_session'
                                                END),
                                    report = ( CASE stu_id
                                                WHEN '$id1' THEN '$replace_name'
                                                WHEN '$id2' THEN '$replace_name'
                                                END)
                                    WHERE stu_id IN ('$id1', '$id2') ";

                            unlink('../uploads/'.$old_file);
                            if(mysqli_query($conn, $sql) && move_uploaded_file($temp_name, $target_dir))
                            {
                                echo "<script>alert('updated sucessfully')</script>";
                            }
                            else{
                                echo "<script>alert('error in query')</script>";
                            }
                        }
                        else if($one_valid && !isset($m2_name) && !isset($m3_name))
                        {
                            // one
                            $sql = "UPDATE thesis_project_info
                                    SET
                                    stu_id = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_id'
                                                END),
                                    stu_name = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_name'
                                                END),
                                    batch = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_batch'
                                                END),
                                    semester = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_semester'
                                                END),
                                    credit = ( CASE stu_id
                                                WHEN '$id1' THEN '$m1_credit'
                                                END), 
                                    title = ( CASE stu_id
                                                WHEN '$id1' THEN '$title'
                                                END),
                                    catagory = ( CASE stu_id
                                                WHEN '$id1' THEN '$catagory'
                                                END),
                                    st_session = ( CASE stu_id
                                                WHEN '$id1' THEN '$st_session'
                                                END),
                                    end_session = ( CASE stu_id
                                                WHEN '$id1' THEN '$end_session'
                                                END),
                                    report = ( CASE stu_id
                                                WHEN '$id1' THEN '$replace_name'
                                                END)
                                    WHERE stu_id IN ('$id1') ";

                            unlink('../uploads/'.$old_file);
                            if(mysqli_query($conn, $sql) && move_uploaded_file($temp_name, $target_dir))
                            {
                                echo "<script>alert('updated sucessfully')</script>";
                            }
                            else{
                                echo "<script>alert('error in query')</script>";
                            }
                        }
                    }
                    else{
                        $file_error = "* file must be less then 5 Mb";
                        echo "<script>alert('file must be less then 5 Mb')</script>";
                    }
                }
                else{
                    $file_error = "* the file was not PDF";
                    echo "<script>alert('file was not PDF')</script>";
                }

                
            }
            else{
                // NO FILE
                if($all_valid && $two_valid && $one_valid)
                {
                    //all
                    $sql = "UPDATE thesis_project_info
                            SET
                            stu_id = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_id'
                                        WHEN '$id2' THEN '$m2_id'
                                        WHEN '$id3' THEN '$m3_id'
                                        END),
                            stu_name = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_name'
                                        WHEN '$id2' THEN '$m2_name'
                                        WHEN '$id3' THEN '$m3_name'
                                        END),
                            batch = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_batch'
                                        WHEN '$id2' THEN '$m2_batch'
                                        WHEN '$id3' THEN '$m3_batch'
                                        END),
                            semester = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_semester'
                                        WHEN '$id2' THEN '$m2_semester'
                                        WHEN '$id3' THEN '$m3_semester'
                                        END),
                            credit = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_credit'
                                        WHEN '$id2' THEN '$m2_credit'
                                        WHEN '$id3' THEN '$m3_credit'
                                        END), 
                            title = ( CASE stu_id
                                        WHEN '$id1' THEN '$title'
                                        WHEN '$id2' THEN '$title'
                                        WHEN '$id3' THEN '$title'
                                        END),
                            catagory = ( CASE stu_id
                                        WHEN '$id1' THEN '$catagory'
                                        WHEN '$id2' THEN '$catagory'
                                        WHEN '$id3' THEN '$catagory'
                                        END),
                            st_session = ( CASE stu_id
                                        WHEN '$id1' THEN '$st_session'
                                        WHEN '$id2' THEN '$st_session'
                                        WHEN '$id3' THEN '$st_session'
                                        END),
                            end_session = ( CASE stu_id
                                        WHEN '$id1' THEN '$end_session'
                                        WHEN '$id2' THEN '$end_session'
                                        WHEN '$id3' THEN '$end_session'
                                        END)
                            WHERE stu_id IN ('$id1', '$id2', '$id3') ";

                    if(mysqli_query($conn, $sql))
                    {
                        echo "<script>alert('updated sucessfully')</script>";
                    }
                    else{
                        echo "<script>alert('error in query')</script>";
                    }
                }
                else if($two_valid && !isset($m3_name) && $one_valid)
                {
                    // two
                    $sql = "UPDATE thesis_project_info
                            SET
                            stu_id = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_id'
                                        WHEN '$id2' THEN '$m2_id'
                                        END),
                            stu_name = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_name'
                                        WHEN '$id2' THEN '$m2_name'
                                        END),
                            batch = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_batch'
                                        WHEN '$id2' THEN '$m2_batch'
                                        END),
                            semester = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_semester'
                                        WHEN '$id2' THEN '$m2_semester'
                                        END),
                            credit = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_credit'
                                        WHEN '$id2' THEN '$m2_credit'
                                        END), 
                            title = ( CASE stu_id
                                        WHEN '$id1' THEN '$title'
                                        WHEN '$id2' THEN '$title'
                                        END),
                            catagory = ( CASE stu_id
                                        WHEN '$id1' THEN '$catagory'
                                        WHEN '$id2' THEN '$catagory'
                                        END),
                            st_session = ( CASE stu_id
                                        WHEN '$id1' THEN '$st_session'
                                        WHEN '$id2' THEN '$st_session'
                                        END),
                            end_session = ( CASE stu_id
                                        WHEN '$id1' THEN '$end_session'
                                        WHEN '$id2' THEN '$end_session'
                                        END)
                            WHERE stu_id IN ('$id1', '$id2') ";
                    
                    if(mysqli_query($conn, $sql))
                    {
                        echo "<script>alert('updated sucessfully')</script>";
                    }
                    else{
                        echo "<script>alert('error in query')</script>";
                    }
                }
                else if($one_valid && !isset($m2_name) && !isset($m3_name))
                {
                    // one
                    $sql = "UPDATE thesis_project_info
                            SET
                            stu_id = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_id'
                                        END),
                            stu_name = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_name'
                                        END),
                            batch = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_batch'
                                        END),
                            semester = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_semester'
                                        END),
                            credit = ( CASE stu_id
                                        WHEN '$id1' THEN '$m1_credit'
                                        END), 
                            title = ( CASE stu_id
                                        WHEN '$id1' THEN '$title'
                                        END),
                            catagory = ( CASE stu_id
                                        WHEN '$id1' THEN '$catagory'
                                        END),
                            st_session = ( CASE stu_id
                                        WHEN '$id1' THEN '$st_session'
                                        END),
                            end_session = ( CASE stu_id
                                        WHEN '$id1' THEN '$end_session'
                                        END)
                            WHERE stu_id IN ('$id1') ";
                    
                    if(mysqli_query($conn, $sql))
                    {
                        echo "<script>alert('updated sucessfully')</script>";
                    }
                    else{
                        echo "<script>alert('error in query')</script>";
                    }
                }
            }
        
        

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update group info</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/supervisor.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/footer.css">

</head>
<body>
    
    <?php require_once '../partials/nav.php' ?>

    <div class="container">
        
        <?php require_once 'admin_side_nav.php' ?>

        

        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1>edit team info</h1>
                </div>

                <div class="form_div">
                    <form action="" method="POST" enctype="multipart/form-data">
                
                        <div class="fields">
                            <label for="title" class="bdr">Thesis/Project title</label>
                            <input type="text" name="title" id="title" placeholder="Thesis/Project title" value="<?php echo isset($title) ? $title : '' ?>">
                            <p class="error_msg"><?php echo isset($title_error) ? $title_error : '' ?></p>
                        </div>
        
                        <div class="fields radio">
                            <label class="bdr">Catagory</label>
                            <br>
                            <input type="radio" name="catagory" id="thesis" value="thesis" <?php if(isset($catagory)){if($catagory == 'thesis'){echo 'checked';}} ?> >
                            <label for="thesis">Thesis</label>
                            <br>
                            <input type="radio" name="catagory" id="project" value="project" <?php if(isset($catagory)){if($catagory == 'project'){echo 'checked';}} ?> >
                            <label for="project">Project</label>

                            <p class="error_msg"><?php echo isset($cat_error) ? $cat_error : '' ?></p>
                        </div>
                        
                        <div class="members">
                            <label for="" class="bdr">1st member</label>
                            <div class="member_about">
                                <div class="nested_box">
                                    <label for="m1_name">name</label>
                                    <input type="text" name="1_name" id="m1_name" placeholder="name" value="<?php echo isset($m1_name) ? $m1_name : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_id">id</label>
                                    <input type="text" name="1_id" id="m1_id" placeholder="id" value="<?php echo isset($m1_id) ? $m1_id : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_batch">batch</label>
                                    <input type="text" name="1_batch" id="m1_batch" placeholder="batch" value="<?php echo isset($m1_batch) ? $m1_batch : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_sem">semester</label>
                                    <input type="text" name="1_semester" id="m1_sem" placeholder="semester" value="<?php echo isset($m1_semester) ? $m1_semester : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_credit">credit</label>
                                    <input type="text" name="1_credit" id="m1_credit" placeholder="credit" value="<?php echo isset($m1_credit) ? $m1_credit : '' ?>">
                                </div>
                        
                            </div>
                            <p class="error_msg"><?php echo isset($m1_error) ? $m1_error : '' ?></p>
                        </div>
        
                        <div class="members">
                            <label for="" class="bdr">2nd member</label>
                            <div class="member_about">
                            <div class="nested_box">
                                    <label for="m2_name">name</label>
                                    <input type="text" name="2_name" id="m2_name" placeholder="name" value="<?php echo isset($m2_name) ? $m2_name : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m2_id">id</label>
                                    <input type="text" name="2_id" id="m2_id" placeholder="id" value="<?php echo isset($m2_id) ? $m2_id : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m2_batch">batch</label>
                                    <input type="text" name="2_batch" id="m2_batch" placeholder="batch" value="<?php echo isset($m2_batch) ? $m2_batch : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m2_sem">semester</label>
                                    <input type="text" name="2_semester" id="m2_sem" placeholder="semester" value="<?php echo isset($m2_semester) ? $m2_semester : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m2_credit">credit</label>
                                    <input type="text" name="2_credit" id="m2_credit" placeholder="credit" value="<?php echo isset($m2_credit) ? $m2_credit : '' ?>">
                                </div>
                            </div>
                            <p class="error_msg"><?php if(isset($m1_name) && isset($m2_name) && isset($m2_error)){echo $m2_error;} ?></p>
                        </div>
        
                        <div class="members">
                            <label for="" class="bdr">3rd member</label>
                            <div class="member_about">
                            <div class="nested_box">
                                    <label for="m3_name">name</label>
                                    <input type="text" name="3_name" id="m3_name" placeholder="name" value="<?php echo isset($m3_name) ? $m3_name : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m3_id">id</label>
                                    <input type="text" name="3_id" id="m3_id" placeholder="id" value="<?php echo isset($m3_id) ? $m3_id : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m3_batch">batch</label>
                                    <input type="text" name="3_batch" id="m3_batch" placeholder="batch" value="<?php echo isset($m3_batch) ? $m3_batch : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m3_sem">semester</label>
                                    <input type="text" name="3_semester" id="m3_sem" placeholder="semester" value="<?php echo isset($m3_semester) ? $m3_semester : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m3_credit">credit</label>
                                    <input type="text" name="3_credit" id="m3_credit" placeholder="credit" value="<?php echo isset($m3_credit) ? $m3_credit : '' ?>">
                                </div>
                            </div>
                            <p class="error_msg"><?php if(isset($m1_name) && isset($m2_name) && isset($m3_name) && isset($m3_error)){echo $m3_error;} ?></p>
                        </div>
        
                        <div class="fields dates">
                            <label for="s_date" class="bdr">Starting session</label>
                            <div class="select-box">
                                <select name="s_sName" id="">
                                    <option value="0">Select session</option>
                                    <option value="spring" <?php if(isset($s_sName)){if($s_sName == 'spring'){echo 'selected';}} ?>>Spring</option>
                                    <option value="summer" <?php if(isset($s_sName)){if($s_sName == 'summer'){echo 'selected';}} ?>>Summer</option>
                                    <option value="fall" <?php if(isset($s_sName)){if($s_sName == 'fall'){echo 'selected';}} ?>>fall</option>
                                </select>
            
                                <select name="s_sYear" id="">
                                    <option value="0">Select year</option>
                                    <?php 
                                        // $today = date("d-m-Y");
                                        // echo $today;
                                        // echo date('Y');
                                        $c_year = date('Y');
                                        for($i = $c_year; $i >= $c_year-3; $i--)
                                        {
                                            ?>
                                            <option value="<?php echo $i?>" <?php if(isset($s_sYear)){if($s_sYear == $i){echo 'selected';}} ?>><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <p class="error_msg"><?php echo isset($st_sess_error) ? $st_sess_error : '' ?></p>
                        </div>
        
                        <div class="fields dates">
                            <label for="s_date" class="bdr">Ending session</label>
                            <div class="select-box">
                                <select name="e_sName" id="">
                                    <option value="0">Select session</option>
                                    <option value="spring" <?php if(isset($e_sName)){if($e_sName == 'spring'){echo 'selected';}} ?>>Spring</option>
                                    <option value="summer" <?php if(isset($e_sName)){if($e_sName == 'summer'){echo 'selected';}} ?>>Summer</option>
                                    <option value="fall" <?php if(isset($e_sName)){if($e_sName == 'fall'){echo 'selected';}} ?>>fall</option>
                                </select>
            
                                <select name="e_sYear" id="">
                                    <option value="0">Select year</option>
                                    <?php 
                                        // $today = date("d-m-Y");
                                        // echo $today;
                                        // echo date('Y');
                                        $c_year = date('Y');
                                        for($i = $c_year; $i >= $c_year-3; $i--)
                                        {
                                            ?>
                                            <option value="<?php echo $i ?>" <?php if(isset($e_sYear)){if($e_sYear == $i){echo 'selected';}} ?>><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <p class="error_msg"><?php echo isset($end_sess_error) ? $end_sess_error : '' ?></p>
                        </div>
        
                        <!-- <div class="fields">
                            <label for="supervisor" class="bdr">Supervisor name</label>
                            <input type="text" name="supervisor" id="supervisor" placeholder="Supervisor name">
                        </div> -->
        
                        <div class="fields">
                            <input type="file" name="file" id="file">
                            <label for="file"><i class="fa-solid fa-upload"></i>Choose a report...</label>
                            <span id="file-chosen"></span>
                            <p class="error_msg"><?php echo isset($file_error) ? $file_error : '' ?></p>
                        </div>

                        <!-- <b>Old file: </b><i><?php echo $old_file; ?></i> -->
                        <div class="fields">
                            <button name="view" style="padding: 10px 15px; cursor: pointer;"><b>Old file: </b><i><?php echo $old_file; ?></i></button>
                        </div>
        
                        <div class="fields">
                            <input type="submit" name="submit" id="submit" >
                        </div>
        
        
                    </form>
                </div>
            </div>
            
        </div>
    </div>

    <?php require_once '../partials/footer.php' ?>

    <script src="../js/register.js"></script>

</body>
</html>