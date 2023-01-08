<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
require '../excel_to_database/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\xlsx;

$page = 'supervisor_assign';

if (isset($_POST['submit'])) {
    $allowed = ['xlx', 'csv', 'xlsx'];

    $file_name = $_FILES["file"]["name"];
    $check = explode(".", $file_name);
    $extension = end($check);
    // $tmp_name = $_FILES["file"]["tmp_name"];
    // echo $extension;
    // print_r($_FILES);

    $semester = $_POST['semester'];
    // echo $semester;


    if (in_array($extension, $allowed)) {
        $target_file = $_FILES["file"]["tmp_name"];

        /** Load $inputFileName to a Spreadsheet object **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($target_file);
        $data = $spreadsheet->getActiveSheet()->toArray();
        array_splice($data, 0, 1);

        $null_index = 0;
        foreach ($data as $key => $value) {
            if ($value[1] == null) {
                $null_index = $key;
                break;
            }
        }
        $null_count = count($data) - $null_index;
        array_splice($data, $null_index, $null_count);

        foreach ($data as $row) {
            $name1 = htmlspecialchars($row[1]);
            $id1 = htmlspecialchars($row[2]);
            $sec1 = htmlspecialchars($row[3]);

            $name2 = htmlspecialchars($row[4]);
            $id2 = htmlspecialchars($row[5]);
            $sec2 = htmlspecialchars($row[6]);

            $name3 = htmlspecialchars($row[7]);
            $id3 = htmlspecialchars($row[8]);
            $sec3 = htmlspecialchars($row[9]);

            $title = htmlspecialchars($row[10]);
            $supervisor = htmlspecialchars($row[11]);

            $team_code = date("Y") . "_" . rand(111111, 999999);

            // echo $name1." ".$id1." ".$sec1."<br>";
            // echo $name2." ".$id2." ".$sec2."<br>";
            // echo $name3." ".$id3." ".$sec3."<br>";
            // echo "<br><br>";

            // echo "Team code = ".$team_code."<br>";

            if (!empty($name1) && !empty($id1) && !empty($sec1) && !empty($name2) && !empty($id2) && !empty($sec2) && !empty($name3) && !empty($id3) && !empty($sec3) && !empty($title) && !empty($supervisor)) {
                // 3 member
                $sql = "INSERT INTO students 
                            (name, id, semester, section, title, supervisor, credit, teamCode)
                            VALUES
                            ('$name1', '$id1', '$semester', '$sec1', '$title', '$supervisor', '0', '$team_code'),
                            ('$name2', '$id2', '$semester', '$sec2', '$title', '$supervisor', '0', '$team_code'),
                            ('$name3', '$id3', '$semester', '$sec3', '$title', '$supervisor', '0', '$team_code')";
                $query = mysqli_query($conn, $sql);
            } elseif (!empty($name1) && !empty($id1) && !empty($sec1) && !empty($name2) && !empty($id2) && !empty($sec2) && empty($name3) && empty($id3) && empty($sec3) && !empty($title) && !empty($supervisor)) {
                // 2 member
                $sql = "INSERT INTO students 
                            (name, id, semester, section, title, supervisor, credit, teamCode)
                            VALUES
                            ('$name1', '$id1', '$semester', '$sec1', '$title', '$supervisor', '0', '$team_code'),
                            ('$name2', '$id2', '$semester', '$sec2', '$title', '$supervisor', '0', '$team_code')";
                $query = mysqli_query($conn, $sql);

            } elseif (!empty($name1) && !empty($id1) && !empty($sec1) && empty($name2) && empty($id2) && empty($sec2) && empty($name3) && empty($id3) && empty($sec3) && !empty($title) && !empty($supervisor)) {
                // 1 member
                $sql = "INSERT INTO students 
                            (name, id, semester, section, title, supervisor, credit, teamCode)
                            VALUES
                            ('$name1', '$id1', '$semester', '$sec1', '$title', '$supervisor', '0', '$team_code')";
                $query = mysqli_query($conn, $sql);
            }

        }




    } else {
        echo "<script>alert('this is not a exel file')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supervisor assign</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/supervisor_assign.css">

</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>



        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1><i class="fa-solid fa-square-caret-right" id="side_arow"></i> supervisor assign</h1>
                </div>

                <div class="form_div">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="fields">
                            <div class="radio">
                                <input type="radio" name="semester" value="10" id="sem10" checked>
                                <label for="sem10">10th semester</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="semester" value="11" id="sem11">
                                <label for="sem11">11th semester</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="semester" value="12" id="sem12">
                                <label for="sem12">12th semester</label>
                            </div>
                        </div>
                        <div class="fields">
                            <input type="file" name="file" id="file">
                            <label for="file"><i class="fa-solid fa-upload"></i>Choose a xlsx file...</label>
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

    <script src="../js/register.js"></script>

    <script src="../js/nav.js"></script>
    <script src="../js/navSlider.js"></script>
</body>

</html>