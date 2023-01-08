<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'sv_thesis_project_list';

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



if (isset($_POST['search'])) {
    if (!empty($_POST['search_option']) && !empty($_POST['value'])) {
        $search_option = $_POST['search_option'];
        $value = htmlspecialchars($_POST['value']);

        $sql = "SELECT * FROM students WHERE $search_option LIKE '%$value%' AND supervisor = '$sv_short_name'";
        $query = mysqli_query($conn, $sql);
        // if(mysqli_num_rows($query) > 0){
        //     while($row = mysqli_fetch_array($query)){
        //         $name = $row['name'];
        //         $id = $row['id'];
        //         $title = $row['title'];
        //         $credit = $row['credit'];

        //         echo $name." ".$id." ".$title." ".$credit."<br>";
        //     }
        // }
        // else{
        //     echo "search unsucessfull";
        // }
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>thesis project list</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/thesis_project_list.css">
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
                        thesis list
                    </h1>
                </div>

                <div class="filter">
                    <form action="sv_thesis_project_list.php" method="POST">
                        <div class="filter_option">

                            <select name="search_option" id="">
                                <option value="0" <?php if (isset($search_option)) {
                                    if ($search_option === "0") {
                                        echo "selected";
                                    }
                                } ?>>
                                    select search option
                                </option>
                                <option value="id" <?php if (isset($search_option)) {
                                    if ($search_option === "id") {
                                        echo "selected";
                                    }
                                } ?>>
                                    id
                                </option>
                                <option value="name" <?php if (isset($search_option)) {
                                    if ($search_option === "name") {
                                        echo "selected";
                                    }
                                } ?>>
                                    name
                                </option>
                                <option value="title" <?php if (isset($search_option)) {
                                    if ($search_option === "title") {
                                        echo "selected";
                                    }
                                } ?>>
                                    title
                                </option>
                                <option value="exam" <?php if (isset($search_option)) {
                                    if ($search_option === "exam") {
                                        echo "selected";
                                    }
                                } ?>>
                                    exam
                                </option>
                            </select>

                            <input type="text" name="value" value="<?php echo isset($value) ? $value : "" ?>">

                            <input type="submit" name="search" value="search">
                        </div>

                    </form>
                </div>

                <div class="list_content">
                    <table>
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>id</th>
                                <th>title</th>
                                <th>credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!isset($_POST['search'])) {
                                $sql = "SELECT * FROM students WHERE supervisor = '$sv_short_name'";
                                $query = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                            <tr>
                                <td>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['id'] ?>
                                </td>
                                <td>
                                    <?php echo $row['title'] ?>
                                </td>
                                <td>
                                    <?php echo $row['credit'] ?>
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                            } else {
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                            <tr>
                                <td>
                                    <?php echo $row['name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['id'] ?>
                                </td>
                                <td>
                                    <?php echo $row['title'] ?>
                                </td>
                                <td>
                                    <?php echo $row['credit'] ?>
                                </td>
                            </tr>
                            <?php
                                    }
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