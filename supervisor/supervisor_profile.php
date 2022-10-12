
<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    require_once '../partials/db_connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supervisor</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    
    <link rel="stylesheet" href="../fontawesome-6/css/all.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/supervisor.css">
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
                    <h1>dasboard</h1>
                </div>

                    <div class="das_box">
                        <a href="sv_thesis_list.php">
                            <div class="box">
                                <h2>thesis</h2>
                            </div>
                        </a>
                        <a href="project_list.php">
                            <div class="box">
                                <h2>project</h2>
                            </div>
                        </a>
                        <a href="register.php">
                            <div class="box">
                                <h2>register</h2>
                            </div>
                        </a>
                    </div>

            </div>
        </div>


    </div>

    <?php require_once '../partials/footer.php' ?>

    
</body>
</html>