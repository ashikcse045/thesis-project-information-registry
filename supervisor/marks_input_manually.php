<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'manually';

$today = date("Y-m-d");
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

if (isset($_POST['submit'])) {
    $valid = true;
    $valid1 = true;
    $valid2 = true;
    $valid3 = true;
    // $file_valid = true;
    if (!empty($_POST['semester'])) {
        $semester = htmlspecialchars($_POST['semester']);
        // echo $semester;
    } else {
        $valid = false;
        $valid1 = false;
        $valid2 = false;
        $valid3 = false;
        $sem_error = " * select semester first";
    }

    if (!empty($_POST['e_year'])) {
        $exam_year = htmlspecialchars($_POST['e_year']);
    } else {
        $valid = false;
        $valid1 = false;
        $valid2 = false;
        $valid3 = false;
        $exam_error = " * select exam year first";
    }

    if (!empty($_POST['e_session'])) {
        $exam_session = htmlspecialchars($_POST['e_session']);
    } else {
        $valid = false;
        $valid1 = false;
        $valid2 = false;
        $valid3 = false;
        $exam_error = " * select exam session first";
    }


    // member 1 validation

    if (!empty($_POST['m1_id'])) {
        $m1_id = htmlspecialchars($_POST['m1_id']);
    } else {
        $valid = false;
        $valid1 = false;
        $m1_error = " * enter 1st member details first";
    }

    if (!empty($_POST['m1_marks'])) {
        $m1_marks = htmlspecialchars($_POST['m1_marks']);
    } else {
        $valid = false;
        $valid1 = false;
        $m1_error = " * enter 1st member details first";
    }

    if (!empty($_POST['m1_credit'])) {
        $m1_credit = htmlspecialchars($_POST['m1_credit']);
    } else {
        $valid = false;
        $valid1 = false;
        $m1_error = " * enter 1st member details first";
    }

    // member 2 validation

    if (!empty($_POST['m2_id'])) {
        $m2_id = htmlspecialchars($_POST['m2_id']);
    } else {
        $valid2 = false;
        $m2_error = " * enter 2nd member details first";
    }

    if (!empty($_POST['m2_marks'])) {
        $m2_marks = htmlspecialchars($_POST['m2_marks']);
    } else {
        $valid2 = false;
        $m2_error = " * enter 2nd member details first";
    }

    if (!empty($_POST['m2_credit'])) {
        $m2_credit = htmlspecialchars($_POST['m2_credit']);
    } else {
        $valid2 = false;
        $m2_error = " * enter 2nd member details first";
    }

    // member 3 validation

    if (!empty($_POST['m3_id'])) {
        $m3_id = htmlspecialchars($_POST['m3_id']);
    } else {
        $valid3 = false;
        $m3_error = " * enter 3rd member details first";
    }

    if (!empty($_POST['m3_marks'])) {
        $m3_marks = htmlspecialchars($_POST['m3_marks']);
    } else {
        $valid3 = false;
        $m3_error = " * enter 3rd member details first";
    }

    if (!empty($_POST['m3_credit'])) {
        $m3_credit = htmlspecialchars($_POST['m3_credit']);
    } else {
        $valid3 = false;
        $m3_error = " * enter 3rd member details first";
    }


    if ($valid === true && $valid1 === true && $valid2 === true && $valid3 === true) {
        //insert 3 member details without file
        $exam = $exam_session . " - " . $exam_year;
        $sql = "INSERT INTO result (id, semester, exam, marks, credit, supervisor) 
                VALUES
                ('$m1_id', '$semester', '$exam', '$m1_marks', '$m1_credit', '$sv_short_name'),
                ('$m2_id', '$semester', '$exam', '$m2_marks', '$m2_credit', '$sv_short_name'),
                ('$m3_id', '$semester', '$exam', '$m3_marks', '$m3_credit', '$sv_short_name')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('data inserted sucessfully')</script>";
        }

    }

    if ($valid === true && $valid1 === true && $valid2 === true && $valid3 === false) {
        //insert 2 member details without file
        $exam = $exam_session . " - " . $exam_year;
        $sql = "INSERT INTO result (id, semester, exam, marks, credit, supervisor) 
                VALUES
                ('$m1_id', '$semester', '$exam', '$m1_marks', '$m1_credit', '$sv_short_name'),
                ('$m2_id', '$semester', '$exam', '$m2_marks', '$m2_credit', '$sv_short_name')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('data inserted sucessfully')</script>";
        }
    }

    if ($valid === true && $valid1 === true && $valid2 === false && $valid3 === false) {
        //insert 1 member details without file
        $exam = $exam_session . " - " . $exam_year;
        $sql = "INSERT INTO result (id, semester, exam, marks, credit, supervisor) 
            VALUES
            ('$m1_id', '$semester', '$$exam', '$m1_marks', '$m1_credit', '$sv_short_name')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('data inserted sucessfully')</script>";
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
    <title>input manually</title>
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
                        input manually
                    </h1>
                </div>

                <div class="form_div">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="fields dates">
                            <label for="semester" class="bdr">semester</label>
                            <select name="semester" id="semester">
                                <option value="0" <?php if (isset($semester)) {
                                    echo $semester == 0 ? 'selected' : '';
                                } ?>>
                                    select semester
                                </option>
                                <option value="10" <?php if (isset($semester)) {
                                    echo $semester == 10 ? 'selected' : '';
                                } ?>>
                                    10 semester
                                </option>
                                <option value="11" <?php if (isset($semester)) {
                                    echo $semester == 11 ? 'selected' : '';
                                } ?>>
                                    11 semester
                                </option>
                                <option value="12" <?php if (isset($semester)) {
                                    echo $semester == 12 ? 'selected' : '';
                                } ?>>
                                    12 semester
                                </option>

                            </select>
                            <p class=" error_msg">
                                <?php echo isset($sem_error) ? $sem_error : '' ?>
                            </p>
                        </div>
                        <div class="fields dates">
                            <label for="s_date" class="bdr">exam session</label>
                            <div class="select-box">
                                <select name="e_year" id="">
                                    <option value="0">Select year</option>
                                    <?php
                                    // $today = date("d-m-Y");
                                    // echo $today;
                                    // echo date('Y');
                                    $c_year = date('Y');
                                    for ($i = $c_year; $i >= 2012; $i--) {
                                        ?>
                                    <option value="<?php echo $i ?>" <?php if (isset($exam_year)) {
                                               if ($exam_year == $i) {
                                                   echo 'selected';
                                               }
                                           } ?>>
                                        <?php echo $i ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <select name="e_session" id="">
                                    <option value="0">Select session</option>
                                    <option value="spring" <?php if (isset($exam_session)) {
                                        if ($exam_session == 'spring') {
                                            echo 'selected';
                                        }
                                    } ?>>Spring
                                    </option>
                                    <option value="summer" <?php if (isset($exam_session)) {
                                        if ($exam_session == 'summer') {
                                            echo 'selected';
                                        }
                                    } ?>>Summer
                                    </option>
                                    <option value="fall" <?php if (isset($exam_session)) {
                                        if ($exam_session == 'fall') {
                                            echo 'selected';
                                        }
                                    } ?>>fall
                                    </option>
                                </select>
                            </div>
                            <p class=" error_msg">
                                <?php echo isset($exam_error) ? $exam_error : '' ?>
                            </p>
                        </div>


                        <div class="members">
                            <label for="" class="bdr">1st member</label>
                            <div class="member_about">

                                <div class="nested_box">
                                    <label for="m1_id">id</label>
                                    <input type="text" name="m1_id" id="m1_id" placeholder="id"
                                        value="<?php echo isset($m1_id) ? $m1_id : '' ?>">
                                </div>

                                <div class="nested_box">
                                    <label for="m1_marks">cgpa</label>
                                    <input type="text" name="m1_marks" id="m1_marks" placeholder="cgpa"
                                        value="<?php echo isset($m1_marks) ? $m1_marks : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_credit">credit</label>
                                    <input type="text" name="m1_credit" id="m1_credit" placeholder="credit"
                                        value="<?php echo isset($m1_credit) ? $m1_credit : '' ?>">
                                </div>

                            </div>
                            <p class="error_msg">
                                <?php echo isset($m1_error) ? $m1_error : '' ?>
                            </p>
                        </div>
                        <div class="members">
                            <label for="" class="bdr">2nd member</label>
                            <div class="member_about">

                                <div class="nested_box">
                                    <label for="m2_id">id</label>
                                    <input type="text" name="m2_id" id="m1_id" placeholder="id"
                                        value="<?php echo isset($m2_id) ? $m2_id : '' ?>">
                                </div>

                                <div class="nested_box">
                                    <label for="m2_marks">cgpa</label>
                                    <input type="text" name="m2_marks" id="m2_marks" placeholder="cgpa"
                                        value="<?php echo isset($m2_marks) ? $m2_marks : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m1_credit">credit</label>
                                    <input type="text" name="m2_credit" id="m2_credit" placeholder="credit"
                                        value="<?php echo isset($m2_credit) ? $m2_credit : '' ?>">
                                </div>

                            </div>
                            <p class="error_msg">
                                <?php echo isset($m2_error) ? $m2_error : '' ?>
                            </p>
                        </div>
                        <div class="members">
                            <label for="" class="bdr">3rd member</label>
                            <div class="member_about">

                                <div class="nested_box">
                                    <label for="m3_id">id</label>
                                    <input type="text" name="m3_id" id="m3_id" placeholder="id"
                                        value="<?php echo isset($m3_id) ? $m3_id : '' ?>">
                                </div>

                                <div class="nested_box">
                                    <label for="m3_marks">cgpa</label>
                                    <input type="text" name="m3_marks" id="m3_marks" placeholder="cgpa"
                                        value="<?php echo isset($m3_marks) ? $m3_marks : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="m3_credit">credit</label>
                                    <input type="text" name="m3_credit" id="m3_credit" placeholder="credit"
                                        value="<?php echo isset($m3_credit) ? $m3_credit : '' ?>">
                                </div>

                            </div>
                            <p class="error_msg">
                                <?php echo isset($m3_error) ? $m3_error : '' ?>
                            </p>
                        </div>

                        <!-- <div class="fields">
                            <input type="file" name="file" id="file">
                            <label for="file"><i class="fa-solid fa-upload"></i>Choose a report...</label>
                            <span id="file-chosen"></span>
                            <p class="error_msg">
                                <?php echo isset($file_error) ? $file_error : '' ?>
                            </p>
                        </div> -->


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