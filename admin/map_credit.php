<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'map_credit';

if (isset($_POST['submit'])) {
    if (!empty($_POST['semester'])) {
        $semester = $_POST['semester'];
        // echo $semester;
        $sql = "UPDATE students s
                JOIN 
                (SELECT id, sum(credit) AS credit FROM result WHERE semester <= '$semester' GROUP BY id) AS r
                ON s.id = r.id
                SET s.credit = r.credit
                WHERE s.semester = '$semester'";

        // $query = mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('successfully update credit')</script>";
        } else {
            echo "<script>alert('error in sql')</script>";
        }

    } else {
        echo "<script>alert('select semester')</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>map credit</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/map_credit.css">

</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">


                <div class="page_title">
                    <h1><i class="fa-solid fa-square-caret-right" id="side_arow"></i> map credit</h1>
                </div>

                <div class="list_content">

                    <form action="" method="POST">
                        <div class="semesters">
                            <input type="radio" name="semester" value="10" id="sem10">
                            <label for="sem10">10th semester</label>
                            <br>
                            <input type="radio" name="semester" value="11" id="sem11">
                            <label for="sem11">11th semester</label>
                            <br>
                            <input type="radio" name="semester" value="12" id="sem12">
                            <label for="sem12">12th semester</label>
                        </div>
                        <div class="submit_btn">
                            <input type="submit" name="submit" value="submit">
                        </div>
                    </form>

                    <?php
                    // $sql = "select id, sum(credit) as credit from result where id = '191311084'";
                    // $query = mysqli_query($conn, $sql);
                    // while ($row = mysqli_fetch_array($query)) {
                    //     echo $row['id'] . " --> " . $row['credit'] . "<br>";
                    // }
                    ?>
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