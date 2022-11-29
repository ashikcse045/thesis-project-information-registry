<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    require_once '../partials/db_connection.php';

    if(isset($_POST['add']))
    {
        $valid = true;
        if(!empty($_POST['name']))
        {
            $name = $_POST['name'];
        }
        else{
            $valid = false;
            $n_er = "* name is empty";
        }

        if(!empty($_POST['email']))
        {
            $email = $_POST['email'];

            $sql = "select email from sv_table where email = '$email'";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0)
            {
                $valid = false;
                $e_er = "* email already exist";
            }
            else{
                $email = $_POST['email'];
            }

        }
        else{
            $valid = false;
            $e_er = "* email is empty";
        }

        if(!empty($_POST['pass']))
        {
            $p = $_POST['pass'];
            
            if(strlen($_POST['pass']) < 6)
            {
                $valid = false;
                $p_er = "* enter at least 6 character";
            }
            else{
                $pass = md5($_POST['pass']);
            }
            
        }
        else{
            $valid = false;
            $p_er = "* pass is empty";
        }

        if($valid)
        {
            $sql = "insert into sv_table (name, email, pass)
                    values
                    ('$name', '$email', '$pass')";
            
            if(mysqli_query($conn, $sql))
            {
                $name = '';
                $email = '';
                $pass = '';
                $p = '';
                echo "<script>alert('form submitted sucessfully')</script>";
            }
            else{
                echo "<script>alert('form is not submit')</script>";
            }
        }
        else{
            echo "<script>alert('form not valid')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supervisor</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/add_supervisor.css">

</head>
<body>
    
    <?php require_once '../partials/nav.php' ?>

    <div class="container">
        
        <?php require_once 'admin_side_nav.php' ?>

        

        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1>add supervisor</h1>
                </div>

                <div class="form_div">
                    <form action="" method="POST">

                        <div class="box">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name" placeholder="name" value="<?php echo isset($name) ? $name : '' ?>">
                            <p><?php echo isset($n_er) ? $n_er : '' ?></p>
                        </div>

                        <div class="box">
                            <label for="email">email</label>
                            <input type="email" name="email" id="email" placeholder="email" value="<?php echo isset($email) ? $email : '' ?>">
                            <p><?php echo isset($e_er) ? $e_er : '' ?></p>
                        </div>

                        

                        <div class="box">
                            <label for="pass">password</label>
                            <input type="text" name="pass" id="pass" placeholder="password" value="<?php echo isset($p) ? $p : '' ?>">
                            <?php echo isset($p_er) ? $p_er : '' ?>
                        </div>

                        <div class="box btn">
                            
                            <input type="submit" name="add" id="add" value="add">
                        </div>

                    </form>
                </div>
                
            </div>
            
        </div>
    </div>

    <?php require_once '../partials/footer.php' ?>

</body>
</html>