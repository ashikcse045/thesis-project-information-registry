<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'marks_input';

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
    $valid = true;
    if (!empty($_POST['semester'])) {
        $semester = $_POST['semester'];
        $semester_tbl = "semester" . $semester;
    } else {
        $valid = false;
        echo "<script>alert('select semester first')</script>";
    }

    if (!empty($_POST['year'])) {
        $year = $_POST['year'];
    } else {
        $valid = false;
        echo "<script>alert('select year first')</script>";
    }

    if (!empty($_POST['sess'])) {
        $sess = $_POST['sess'];
    } else {
        $valid = false;
        echo "<script>alert('select session first')</script>";
    }

    if (!empty($_FILES['file']['name']) && $valid === true) {
        $exam_session = $sess . "-" . $year;

        $allowed = ['xlx', 'csv', 'xlsx'];

        $file_name = $_FILES["file"]["name"];
        $check = explode(".", $file_name);
        $extension = end($check);
        $tmp_name = $_FILES["file"]["tmp_name"];
        // echo $extension;
        // print_r($_FILES);


        if (in_array($extension, $allowed)) {
            $target_file = $_FILES["file"]["tmp_name"];

            /** Load $inputFileName to a Spreadsheet object **/
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($target_file);
            $data = $spreadsheet->getActiveSheet()->toArray();
            array_splice($data, 0, 1);

            // print_r($data);
            $null_index = 0;
            foreach ($data as $key => $value) {
                if ($value[1] === null) {
                    $null_index = $key;
                    break;
                }
            }
            if ($null_index !== 0) {
                $null_count = count($data) - $null_index;
                array_splice($data, $null_index, $null_count);
            }

            foreach ($data as $row) {
                // print_r($row);
                // echo $row[1];
                // echo "<br><br>";

                $id = $row[1];
                $marks = $row[5];
                $credit = $row[6];

                // echo "id = " . $id . ", semester = " . $semester . ", exam session = " . $exam_session . ", marks = " . $result . ", credit = " . $credit . "<br><br>";

                $sql = "INSERT INTO result (id, semester, exam, marks, credit, supervisor) VALUES
                        ('$id', '$semester', '$exam_session', '$marks', '$credit', '$sv_short_name')";

                mysqli_query($conn, $sql);
            }




        } else {
            echo "this is not a excel file";
        }
    } else {
        echo "<script>alert('select excel file first')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>marks input</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
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
                    <h1>
                        <i class="fa-solid fa-square-caret-right" id="side_arow"></i>
                        marks input
                    </h1>
                </div>

                <div class="form_div">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="fields">
                            <select name="semester" id="semester">
                                <option value="0">select semester</option>
                                <option value="10" <?php if (isset($semester)) {
                                    if ($semester == 10) {
                                        echo 'selected';
                                    }
                                } ?>>10
                                    th</option>
                                <option value="11" <?php if (isset($semester)) {
                                    if ($semester == 11) {
                                        echo 'selected';
                                    }
                                } ?>>11
                                    th</option>
                                <option value="12" <?php if (isset($semester)) {
                                    if ($semester == 12) {
                                        echo 'selected';
                                    }
                                } ?>>12
                                    th</option>
                            </select>
                            <select name="year" id="year">
                                <option value="0">select year</option>
                                <?php
                                for ($i = $year; $i >= 2012; $i--) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                            <select name="sess" id="sess">
                                <option value="0">select session</option>
                                <option value="spring">spring</option>
                                <option value="summer">summer</option>
                                <option value="fall">fall</option>
                            </select>

                        </div>
                        <div class="fields">
                            <input type="file" name="file" id="file">
                            <label for="file"><i class="fa-solid fa-upload"></i>Choose a marks file...</label>
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