<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    require_once 'db_connection.php';

    $batch = '0';
    $semester = '0';
    $ex_session = '0';

    if(isset($_POST['filter']))
    {
        if(!empty($_POST['batch']) && !empty($_POST['semester']) && !empty($_POST['ex_session']))
        {
            $batch = $_POST['batch'];
            $semester = $_POST['semester'];
            $ex_session = $_POST['ex_session'];

            // echo $batch."\n";
            // echo $semester."\n";
            // echo $ex_session."\n";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/footer.css">

</head>
<body>
    
    <?php require_once 'partials/nav.php' ?>

    <div class="container">
        
        <?php require_once 'partials/admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">

                    <div class="filter">
                        <form action="admin.php" method="POST">
                            <div class="filter_option">
                                <select name="batch" id="">
                                    <option value="0">select batch</option>
                                    <?php
                                        for($i = 1; $i <= 50; $i++)
                                        {
                                            ?>
                                            <option value="<?php echo $i ?>" <?php echo $batch==$i ? 'selected' : '' ?>><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>

                                <select name="semester" id="">
                                    <option value="0">select semester</option>
                                    <?php
                                        for($i = 1; $i <= 13; $i++)
                                        {
                                            ?>
                                            <option value="<?php echo $i ?>" <?php echo $semester==$i ? 'selected' : '' ?>><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>

                                <select name="ex_session" id="">
                                    <option value="0">select exam session</option>
                                    <?php
                                        $c_year = date('Y');
                                        for($i = $c_year; $i >= 2012; $i--)
                                        {
                                            ?>
                                            <option value="<?php echo "spring-".$i ?>" <?php echo $ex_session=="spring-".$i ? 'selected' : '' ?>><?php echo "spring-".$i ?></option>
                                            <option value="<?php echo "summer-".$i ?>" <?php echo $ex_session=="summer-".$i ? 'selected' : '' ?>><?php echo "summer-".$i ?></option>
                                            <option value="<?php echo "fall-".$i ?>" <?php echo $ex_session=="fall-".$i ? 'selected' : '' ?>><?php echo "fall-".$i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <input type="submit" name="filter" value="filter">
                            </div>

                        </form>
                    </div>

                <div class="page_title">
                    <h1>thesis list</h1>
                </div>

                <div class="list_content">
                    <ul>
                        <?php
                            $sql = "SELECT * FROM thesis_project_info tp inner join sv_table sv on tp.sv_ref = sv.sv_email where tp.batch = '$batch' and tp.semester = '$semester' and end_session = '$ex_session' and catagory = 'thesis'";
                            // echo $sv_uid;
                            $query = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($query) > 0)
                            {
                                while($row = mysqli_fetch_array($query))
                                {
                                    ?>
                                    
                                    <li>
                                        <a href="#">
                                            <div class="detail">
                                                <ul>
                                                    <li><i class="fa-solid fa-id-card"></i><span><?php echo $row['stu_id'] ?></span></li>
                                                    <li><i class="fa-solid fa-user-graduate"></i><span><?php echo $row['stu_name'] ?></span></li>
                                                    <li><i class="fa-regular fa-calendar-days"></i><?php echo $row['upload_date'] ?></li>
                                                    <li><i class="fa-solid fa-cloud-arrow-up"></i><?php echo $row['sv_name'] ?></li>
                                                </ul>
                                            </div>
                                            <div class="title">
                                                <p><?php echo $row['title'] ?></p>
                                            </div>
                                        </a>
                                    </li>

                                    <?php
                                }
                                
                            }
                        ?>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
    
    <?php require_once 'partials/footer.php' ?>
</body>
</html>