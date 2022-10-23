<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
require_once '../partials/db_connection.php';

$supervisor = '0';
$student = '0';
$ex_session = '0';

if(isset($_POST['filter_sv']))
{
    if(!empty($_POST['supervisor']) && !empty($_POST['st_session']) && !empty($_POST['end_session']))
    {
        $supervisor = $_POST['supervisor'];
        $st_session = $_POST['st_session'];
        $end_session = $_POST['end_session'];

        list($st_sess, $st_year) = explode("-", $st_session);
        list($end_sess, $end_year) = explode("-", $end_session);

        $session_array = array();

        for($i = $st_year; $i<=$end_year; $i++)
        {
            array_push($session_array, 'spring-'.$i, 'summer-'.$i, 'fall-'.$i);
        }

        $key1 = array_search($st_session, $session_array);
        $key2 = array_search($end_session, $session_array);
        $length = $key2 - $key1 + 1;

        $new_session_list = array_slice($session_array,$key1,$length);
        
        // print_r($session_array);
        // echo "<br>";
        // echo $st_session."<br>".$end_session."<br>";
        // echo $key1."<br>".$key2."<br>".$length."<br>";
        // print_r($new_session_list);


    }

}

if(isset($_POST['filter_stu']))
{
    if(!empty($_POST['stu_id']) && !empty($_POST['st_s']) && !empty($_POST['end_s']))
    {
        $student = $_POST['stu_id'];
        $st_session = $_POST['st_s'];
        $end_session = $_POST['end_s'];

        list($st_sess, $st_year) = explode("-", $st_session);
        list($end_sess, $end_year) = explode("-", $end_session);

        $session_array = array();

        for($i = $st_year; $i<=$end_year; $i++)
        {
            array_push($session_array, 'spring-'.$i, 'summer-'.$i, 'fall-'.$i);
        }
        
        $key1 = array_search($st_session, $session_array);
        $key2 = array_search($end_session, $session_array);
        $length = $key2 - $key1 + 1;
        $new_session_list = array_slice($session_array,$key1,$length);

        // print_r($session_array);
        // echo "<br>";
        // echo $st_session."<br>".$end_session."<br>";
        // echo $key1."<br>".$key2."<br>".$length."<br>";
        // print_r($new_session_list);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    
    <link rel="stylesheet" href="../fontawesome-6/css/all.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/supervisor.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/admin_students.css">

    

</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1>supervisor students list</h1>
                </div>

                <div class="list_content">

                    <div class="filter">
                        <form action="students.php" method="POST">
                            <div class="filter_option">
                               
                                <div class="options">
                                    <!-- <label for="sv">select supervisor</label> -->
                                    <select name="supervisor" id="sv">
                                        <option value="0">select supervisor</option>
                                        <?php
                                            $sql = "SELECT * FROM sv_table";
                                            if($query = mysqli_query($conn, $sql))
                                            {
                                                if(mysqli_num_rows($query) > 0)
                                                {
                                                    while($row = mysqli_fetch_array($query))
                                                    {
                                                        ?>
                                                        <option value="<?php echo $row['sv_email'] ?>" <?php echo $supervisor==$row['sv_email'] ? 'selected' : '' ?>><?php echo $row['sv_name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="options">
                                    <!-- <label for="session">select exam session</label> -->
                                    <select name="st_session" id="session">
                                        <option value="0">select start session</option>
                                        <?php
                                            $c_year = date('Y');
                                            for($i = $c_year; $i >= 2012; $i--)
                                            {
                                                ?>
                                                <option value="<?php echo "spring-".$i ?>" ><?php echo "spring-".$i ?></option>
                                                <option value="<?php echo "summer-".$i ?>" ><?php echo "summer-".$i ?></option>
                                                <option value="<?php echo "fall-".$i ?>" ><?php echo "fall-".$i ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="options">
                                    <!-- <label for="session">select exam session</label> -->
                                    <select name="end_session" id="session">
                                        <option value="0">select end session</option>
                                        <?php
                                            $c_year = date('Y');
                                            for($i = $c_year; $i >= 2012; $i--)
                                            {
                                                ?>
                                                <option value="<?php echo "spring-".$i ?>" ><?php echo "spring-".$i ?></option>
                                                <option value="<?php echo "summer-".$i ?>" ><?php echo "summer-".$i ?></option>
                                                <option value="<?php echo "fall-".$i ?>" ><?php echo "fall-".$i ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="options">
                                    <input type="submit" name="filter_sv" value="filter">
                                </div>

                            </div>

                        </form>
                    </div>

                    <div class="filter">
                        <form action="students.php" method="POST">
                            <div class="filter_option">
                                
                            <div class="options">
                                    <!-- <label for="stu">select student</label> -->
                                    <input type="text" name="stu_id" >
                                </div>

                                <div class="options">
                                    <!-- <label for="session2">select exam session</label> -->
                                    <select name="st_s" id="session2">
                                        <option value="0">select start session</option>
                                        <?php
                                            $c_year = date('Y');
                                            for($i = $c_year; $i >= 2012; $i--)
                                            {
                                                ?>
                                                <option value="<?php echo "spring-".$i ?>" ><?php echo "spring-".$i ?></option>
                                                <option value="<?php echo "summer-".$i ?>" ><?php echo "summer-".$i ?></option>
                                                <option value="<?php echo "fall-".$i ?>" ><?php echo "fall-".$i ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="options">
                                    <!-- <label for="session2">select exam session</label> -->
                                    <select name="end_s" id="session2">
                                        <option value="0">select end session</option>
                                        <?php
                                            $c_year = date('Y');
                                            for($i = $c_year; $i >= 2012; $i--)
                                            {
                                                ?>
                                                <option value="<?php echo "spring-".$i ?>" ><?php echo "spring-".$i ?></option>
                                                <option value="<?php echo "summer-".$i ?>" ><?php echo "summer-".$i ?></option>
                                                <option value="<?php echo "fall-".$i ?>" ><?php echo "fall-".$i ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                

                                <div class="options">
                                    <input type="submit" name="filter_stu" value="filter">
                                </div>

                            </div>

                        </form>
                    </div>

        
                    
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>teacher</th>
                                <th>student id</th>
                                <th>semester</th>
                                <th>title</th>
                                <th>catagory</th>
                                <th>exam session</th>
                                <th>credit</th>
                                
                            </tr>
                        </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>teacher</th>
                                <th>student id</th>
                                <th>semester</th>
                                <th>title</th>
                                <th>catagory</th>
                                <th>exam session</th>
                                <th>credit</th>
                                
                            </tr>
                        </tfoot> -->

                        <tbody>

                            <?php

                            // $sql = "SELECT * FROM thesis_project_info ORDER BY sv_id";
                            // $query = mysqli_query($conn, $sql);

                            if($supervisor != 0)
                            {
                                // echo "run supervisor";
                                $sql = "SELECT * FROM thesis_project_info tp inner join sv_table sv on tp.sv_ref = sv.sv_email where tp.sv_ref = '$supervisor'";
                            }
                            else{
                                // echo "run student";
                                $sql = "SELECT * FROM thesis_project_info tp inner join sv_table sv on tp.sv_ref = sv.sv_email where tp.stu_id = '$student'";
                            }

                            $query = mysqli_query($conn, $sql);
                            
                            if(mysqli_num_rows($query) > 0)
                            {


                                while($row = mysqli_fetch_array($query))
                                {
                                    $exam = $row['end_session'];
                                    if(in_array($exam, $new_session_list, TRUE))
                                    {
                                        ?>

                                            <tr>
                                                <td><?php echo $row['sv_name'] ?></td>
                                                <td><?php echo $row['stu_id'] ?></td>
                                                <td><?php echo $row['semester'] ?></td>
                                                <td><?php echo $row['title'] ?></td>
                                                <td><?php echo $row['catagory'] ?></td>
                                                <td><?php echo $row['end_session'] ?></td>
                                                <td><?php echo $row['credit'] ?></td>
                                            </tr>

                                        <?php
                                    }

                                    
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
        
        /*$('#session2').on('change', function(){
            var exam_id = this.value;
            $.ajax({
                url: 'load_data.php',
                type: "POST",
                data: {
                    exam: exam_id
                },
                success: function(result){
                    $('#stu').html(result);
                    console.log(result);
                }
            })
        });*/
    </script>

</body>

</html>