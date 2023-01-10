<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../partials/db_connection.php';

if (isset($_GET['stuID'])) {
    $id = $_GET['stuID'];
    $sql = "SELECT * FROM students WHERE id = '$id'";
    if ($query = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($query) === 1) {
            $row = mysqli_fetch_array($query);

            $name = $row['name'];
            $title = $row['title'];
            $semester = $row['semester'];
            $section = $row['section'];
            $credit = $row['credit'];
            $supervisor = $row['supervisor'];
            // echo $supervisor;

            $team = $row['teamCode'];
        } else {
            header("Location: error.php");
        }
    } else {
        header("Location: error.php");
    }



} else {
    header("Location: error.php");
}

if (isset($_POST['submit'])) {
    $one_valid = true;

    $team_id = "cse_" . rand(10000, 99999);

    //member info check
// NAME
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];

        // ID
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];



            // SESMESTER
            if (!empty($_POST['semester'])) {
                $semester = $_POST['semester'];

                // CREDIT
                if (!empty($_POST['credit'])) {
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

                    if ($query = mysqli_query($conn, $sql)) {
                        echo "<script>
                                    alert('record updated successfully')
                                    </script>";
                    }

                } else {
                    $one_valid = false;
                    $error = "* Please fill 1st member credit field";
                }
            } else {
                $one_valid = false;
                $error = "* Please fill 1st member semester field";
            }

        } else {
            $one_valid = false;
            $error = "* Please fill 1st member id field";
        }
    } else {
        $one_valid = false;
        $error = "* Please fill 1st member name field";
    }

}

// >>** SUBMIT THE FORM **<< } ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update student info</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/edit_student.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php require_once '../partials/nav.php' ?>
    <div class="container">
        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">

                <div class="page_title">
                    <h1>
                        <i class="fa-solid fa-square-caret-right" id="side_arow"></i>
                        update student information
                    </h1>
                </div>

                <div class="form_div">
                    <!-- <h4 style="margin-bottom: 15px; text-transform: capitalize;">
                        <a href="update_group.php?team=<?php echo $team ?>" style="text-decoration: none;">edit team
                            info</a>
                    </h4> -->

                    <div class="title"
                        style="background-color: #395B64; color: #E7F6F2; padding: 10px; font-size: 14px; margin-bottom: 10px;">
                        <h2>
                            <?php echo $title ?>
                        </h2>
                    </div>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="members">
                            <div class="member_about">
                                <div class="nested_box">
                                    <label for="name">name</label>
                                    <input type="text" name="name" id="name" placeholder="name"
                                        value="<?php echo isset($name) ? $name : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="id">id</label>
                                    <input type="text" name="id" id="id" placeholder="id"
                                        value="<?php echo isset($id) ? $id : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="sem">semester</label>
                                    <input type="text" name="semester" id="sem" placeholder="semester"
                                        value="<?php echo isset($semester) ? $semester : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="credit">credit</label>
                                    <input type="text" name="credit" id="credit" placeholder="credit"
                                        value="<?php echo isset($credit) ? $credit : '' ?>">
                                </div>
                                <div class="nested_box">
                                    <label for="supervisor">supervisor</label>
                                    <select name="supervisor" id="supervisor">
                                        <option value="0">select supervisor</option>
                                        <?php
                                        $sql2 = "SELECT * FROM supervisor ORDER BY name ASC";
                                        $query2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($query2) > 0) {
                                            while ($row2 = mysqli_fetch_array($query2)) {
                                                $svName = $row2['name'];
                                                $sName = $row2['sName'];
                                                ?>
                                                <option <?php
                                                echo 'value="' . $sName . '"';
                                                if ($sName === $supervisor) {
                                                    echo "selected";
                                                }
                                                ?>>
                                                    <?php echo $svName . ' (' . $sName . ')'; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <p class="error_msg">
                                <?php echo isset($error) ? $error : '' ?>
                            </p>
                        </div>





                        <div class="fields">
                            <input type="submit" name="submit" id="submit" b value="update">
                            <br>
                            <a href="javascript:history.back()"><i class="fa-solid fa-circle-arrow-left"></i> Back to
                                previous
                                page</a>
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
</body>

</html>