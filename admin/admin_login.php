<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    require_once '../partials/db_connection.php';

    if(isset($_SESSION['ad_id']))
    {
        header("Location: admin.php");
    }

    if(isset($_POST['login']))
    {
        if(!empty($_POST['email']) && !empty($_POST['pass']))
        {
            
            $email = test_input($conn, $_POST['email']);
            $pass = test_input($conn, $_POST['pass']);
            
            $pass = md5($pass);
            // echo $pass;

            $sql = "select * from a_d_m_i_n where email = '$email' and password = '$pass'";
            $query = mysqli_query($conn, $sql);

            if(mysqli_num_rows($query) === 1)
            {
                $_SESSION['ad_id'] = $email;
                header("Location: admin.php");
            }
        }
        else{
            $error = "* invalid username or password";
        }
    }

    function test_input($con, $data) 
    {
        $data = trim($data);
        $data = mysqli_real_escape_string($con, $data);
        return $data;
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../fontawesome-6/css/all.css">
    <link rel="stylesheet" href="../css/admin_login.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    

    <title>admin login</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>
<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">
        <div class="login_box">
            <form action="" method="POST">
                <div class="icon">
                    <!-- <i class="fa-solid fa-user-large"></i> -->
                    <img src="../images/user_admin4.svg" alt="">
                    <p>admin login</p>
                </div>
                <div class="fields">
                    <label for="email"><i class="fa-solid fa-envelope"></i></label>
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>

                <div class="fields">
                    <label for="pass"><i class="fa-solid fa-key"></i></label>
                    <input type="password" name="pass" id="pass" placeholder="password">
                </div>

                <div class="btn">
                    <input type="submit" name="login" id="login" value="sign in">
                    <a href="#">forgot password?</a>
                </div>
            </form>
        </div>
    </div>

    <?php require_once '../partials/footer.php' ?>
    
</body>
</html>