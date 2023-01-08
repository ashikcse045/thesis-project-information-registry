<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'supervisor_list';

if (isset($_POST['add'])) {
    $valid = true;
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $valid = false;
        $n_er = "* name is empty";
    }

    if (!empty($_POST['sName'])) {
        $sName = $_POST['sName'];
    } else {
        $valid = false;
        $s_er = "* short name is empty";
    }

    if (!empty($_POST['email'])) {
        $email = $_POST['email'];

        $sql = "select email from supervisor where email = '$email'";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $valid = false;
            $e_er = "* email already exist";
        } else {
            $email = $_POST['email'];
        }

    } else {
        $valid = false;
        $e_er = "* email is empty";
    }

    if (!empty($_POST['emp_id'])) {
        $emp_id = $_POST['emp_id'];
    } else {
        $valid = false;
        $emp_er = "* employee id is empty";
    }

    if (!empty($_POST['pass'])) {
        $p = $_POST['pass'];

        if (strlen($_POST['pass']) < 6) {
            $valid = false;
            $p_er = "* enter at least 6 character";
        } else {
            $pass = md5($_POST['pass']);
        }

    } else {
        $valid = false;
        $p_er = "* pass is empty";
    }

    if ($valid) {
        $sql = "insert into supervisor (name, sName, email, emp_id, password)
                    values
                    ('$name', '$sName', '$email', '$emp_id', '$pass')";

        if (mysqli_query($conn, $sql)) {
            $name = '';
            $email = '';
            $pass = '';
            $p = '';
            echo "<script>alert('form submitted sucessfully')</script>";
        } else {
            echo "<script>alert('form is not submit')</script>";
        }
    } else {
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
    <title>supervisor list</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/supervisor_list.css">

</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>



        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1><i class="fa-solid fa-square-caret-right" id="side_arow"></i>supervisor list</h1>
                </div>

                <div class="list_content">
                    <table>
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>short name</th>
                                <th>email</th>
                                <th>employee id</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select * from supervisor";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                            <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td>
                                    <?php echo $row['sName'] ?>
                                </td>
                                <td><?php echo $row['email'] ?></td>
                                <td>
                                    <?php echo $row['emp_id'] ?>
                                </td>
                                <td><a href="edit_supervisor.php?id=<?php echo $row['emp_id'] ?>">update</a> / <a
                                        href="delete_supervisor.php?id=<?php echo $row['emp_id'] ?>">delete</a></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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