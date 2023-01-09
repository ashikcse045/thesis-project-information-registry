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
            $row2 = mysqli_fetch_array($query);

            $name = $row2['name'];
            $title = $row2['title'];
            $semester = $row2['semester'];
            $section = $row2['section'];
            // $supervisor = $row2['supervisor'];

            $team = $row2['teamCode'];
        } else {
            header("Location: error.php");
        }

    } else {
        header("Location: error.php");
    }


} else {
    header("Location: error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student details</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/student_details.css">


</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1><i class="fa-solid fa-square-caret-right" id="side_arow"></i>student details</h1>
                </div>
                <div class="list_content">
                    <div class="student_info">
                        <table>
                            <tr>
                                <th>name</th>
                                <th>: </th>
                                <td>
                                    <?php echo $name ?>
                                </td>
                            </tr>
                            <tr>
                                <th>id</th>
                                <th>: </th>
                                <td>
                                    <?php echo $id ?>
                                </td>
                            </tr>
                            <tr>
                                <th>semester</th>
                                <th>: </th>
                                <td>
                                    <?php echo $semester ?>
                                </td>
                            </tr>
                            <tr>
                                <th>section</th>
                                <th>: </th>
                                <td>
                                    <?php echo $section ?>
                                </td>
                            </tr>
                            <tr>
                                <th>title</th>
                                <th>: </th>
                                <td>
                                    <?php echo $title ?>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th><a href="#">team mates</a></A></th>
                            </tr> -->
                        </table>
                        <a href="update_student.php?stuID=<?php echo $id; ?>">click to edit</a>
                    </div>
                    <div class="details">
                        <?php
                        $sql3 = "SELECT * FROM result WHERE id = '$id' ORDER BY semester DESC";
                        $query3 = mysqli_query($conn, $sql3);
                        ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>semester</th>
                                    <th>exam</th>
                                    <th>cgpa</th>
                                    <th>credit</th>
                                    <th>supervisor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($query3) > 0) {
                                    while ($row3 = mysqli_fetch_array($query3)) {
                                        ?>
                                <tr>
                                    <td><?php echo $row3['semester'] ?></td>
                                    <td>
                                        <?php echo $row3['exam'] ?>
                                    </td>
                                    <td><?php echo $row3['marks'] ?></td>
                                    <td>
                                        <?php echo $row3['credit'] ?>
                                    </td>
                                    <td><?php echo $row3['supervisor'] ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="other_team_mates">

                        <button id="view_btn">view team mates</button>
                        <div class="show_team_mate">

                            <?php
                            $sql4 = "SELECT * FROM students WHERE teamCode = '$team' AND id <> '$id'";
                            $query4 = mysqli_query($conn, $sql4);
                            if (mysqli_num_rows($query4) > 0) {
                                while ($row4 = mysqli_fetch_array($query4)) {
                                    ?>
                            <div class="list">
                                <a href="student_details.php?stuID=<?php echo $row4['id']; ?>">
                                    <span>
                                        <?php echo $row4['id'] ?>
                                    </span>
                                    <span>
                                        <?php echo $row4['name'] ?>
                                    </span>
                                    <!-- <h3><?php echo $row4['title'] ?></h3> -->
                                </a>
                            </div>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require_once '../partials/footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="../js/student_details.js"></script>
    <script src="../js/nav.js"></script>
    <script src="../js/navSlider.js"></script>
</body>

</html>