<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'uploadReport';

require '../excel_to_database/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\xlsx;

if (isset($_SESSION['sv_id'])) {
    $sv_uid = $_SESSION['sv_id'];
    $sql = "select name, sName from supervisor where email='$sv_uid'";
    $query = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($query)) {
        $sv_name = $row['name'];
        $sv_short_name = $row['sName'];
    }

    // echo $sv_short_name;


} else {
    header("Location: supervisor_login.php");
}

$today = date("Y-m-d");
$sv_uid = $_SESSION['sv_id'];
// $sql = "select id from sv_table where email='$uid'";
// $query = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($query);
$sv_ref = $sv_uid;

$year = date('Y');
// echo $year;

if (isset($_POST['submit'])) {


    if (!empty($_FILES['report'])) {
        $dir = '../uploads/';
        $file_name = '';
        foreach ($_FILES['report']['name'] as $key => $value) {
            if ($_FILES['report']['type'][$key] !== 'application/pdf') {
                continue;
            }
            $file_name = $_FILES['report']['name'][$key];
            $basename = pathinfo($file_name, PATHINFO_FILENAME);
            $id_list = explode('+', $basename);

            $member = count($id_list);
            if ($member === 1) {
                $id1 = $id_list[0];
                // echo "1 member<br>" . $id1 . "<br><br>";
                $sql1 = "SELECT * FROM students WHERE id = '$id1' AND supervisor = '$sv_short_name'";
                $query = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($query) > 0) {
                    // echo "1" . "<br><br>";
                    $sql2 = "UPDATE students
                        SET
                        report_file = '$file_name'
                        WHERE id = '$id1'";

                    if (mysqli_query($conn, $sql2)) {
                        $file_path = "../uploads/" . $file_name;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                        move_uploaded_file($_FILES['report']['tmp_name'][$key], $dir . $value);
                    }
                }


            } elseif ($member === 2) {
                $id1 = $id_list[0];
                $id2 = $id_list[1];
                // echo "2 member<br>" . $id1 . "<br>" . $id2 . "<br><br>";
                $sql1 = "SELECT * FROM students WHERE id IN('$id1', '$id2') AND supervisor = '$sv_short_name'";
                $query = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($query) > 0) {
                    // echo "2" . "<br><br>";
                    $sql2 = "UPDATE students
                        SET
                        report_file = (CASE id 
                                   WHEN '$id1' THEN '$file_name' 
                                   WHEN '$id2' THEN '$file_name' 
                                   ELSE report_file 
                                   END)
                                   WHERE id IN('$id1', '$id2')";

                    if (mysqli_query($conn, $sql2)) {
                        $file_path = "../uploads/" . $file_name;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                        move_uploaded_file($_FILES['report']['tmp_name'][$key], $dir . $value);
                    }
                }
            } elseif ($member === 3) {
                $id1 = $id_list[0];
                $id2 = $id_list[1];
                $id3 = $id_list[2];

                // echo "3 member<br>" . $id1 . "<br>" . $id2 . "<br>" . $id3 . "<br><br>";
                $sql1 = "SELECT * FROM students WHERE id IN('$id1', '$id2', '$id3') AND supervisor = '$sv_short_name'";
                $query = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($query) > 0) {
                    // echo "3" . "<br><br>";
                    $sql2 = "UPDATE students
                        SET
                        report_file = (CASE id 
                                   WHEN '$id1' THEN '$file_name' 
                                   WHEN '$id2' THEN '$file_name' 
                                   WHEN '$id3' THEN '$file_name' 
                                   ELSE report_file 
                                   END)
                                   WHERE id IN('$id1', '$id2', '$id3')";

                    if (mysqli_query($conn, $sql2)) {
                        $file_path = "../uploads/" . $file_name;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                        move_uploaded_file($_FILES['report']['tmp_name'][$key], $dir . $value);
                        // echo "<script>alert('file uploaded sucessfully')<script/>";
                    }
                }
            } else {
                continue;
            }
            // move_uploaded_file($_FILES['report']['tmp_name'][$key], $dir . $value);

        }
        echo "<script>alert('all done')</script>";

    } else {
        echo "<script>alert('select students report file first')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload report</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/marks_input.css">
    <link rel="stylesheet" href="../css/footer.css">

</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'sv_side_nav.php' ?>



        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1>
                        <i class="fa-solid fa-square-caret-right" id="side_arow"></i>
                        upload report
                    </h1>
                </div>

                <div class="form_div">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="fields">
                            <input type="file" name="report[]" id="file" multiple>
                            <label for="file"><i class="fa-solid fa-upload"></i>Choose report files...</label>
                            <span id="file-chosen"></span>
                            <p class="error_msg">
                                <?php echo isset($file_error) ? $file_error : '' ?>
                            </p>
                        </div>

                        <div class="fields">
                            <input type="submit" name="submit" id="submit">
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php require_once '../partials/footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/navSlider.js"></script>
    <script src="../js/register.js"></script>

</body>

</html>