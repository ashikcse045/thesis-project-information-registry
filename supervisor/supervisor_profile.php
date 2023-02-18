<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'supervisor_profile';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supervisor</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/sv_dashboard.css">
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
                        dasboard
                    </h1>
                </div>

                <div class="das_box">
                    <a href="sv_thesis_project_list.php">
                        <div class="box">
                            <h2>thesis / project</h2>
                        </div>
                    </a>
                    <!-- <a href="project_list.php">
                            <div class="box">
                                <h2>project</h2>
                            </div>
                        </a> -->
                    <a href="my_students.php">
                        <div class="box">
                            <h2>my students</h2>
                        </div>
                    </a>
                    <a href="marks_input.php">
                        <div class="box">
                            <h2>marks input</h2>
                        </div>
                    </a>

                    <a href="upload_report.php">
                        <div class="box">
                            <h2>upload thesis report</h2>
                        </div>
                    </a>
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