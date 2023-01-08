<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'all_list';

if (isset($_POST['search'])) {
    if (!empty($_POST['search_option'])) {
        $search_option = $_POST['search_option'];
    }
    if (!empty($_POST['value'])) {
        $value = htmlspecialchars($_POST['value']);
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

    <!-- data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.5.1/css/autoFill.dataTables.min.css">

    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/thesis_project_list.css">
    <link rel="stylesheet" href="../css/admin_all_list.css">

</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1><i class="fa-solid fa-square-caret-right" id="side_arow"></i> thesis / project list</h1>
                </div>

                <div class="search">
                    <form action="admin_all_list.php" method="POST">
                        <div class="search_option">

                            <select name="search_option" id="">
                                <option value="0" <?php if (isset($search_option)) {
                                    if ($search_option === "0") {
                                        echo
                                            "selected";
                                    }
                                } ?>>
                                    select search option
                                </option>
                                <option value="id" <?php if (isset($search_option)) {
                                    if ($search_option === "id") {
                                        echo
                                            "selected";
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
                                <option value="semester" <?php if (isset($search_option)) {
                                    if ($search_option === "semester") {
                                        echo "selected";
                                    }
                                } ?>>
                                    semester
                                </option>
                                <!-- <option value="exam" <?php if (isset($search_option)) {
                                    if ($search_option === "exam") {
                                        echo "selected";
                                    }
                                } ?>>
                                    exam
                                </option> -->
                            </select>

                            <input type="text" name="value" value="<?php echo isset($value) ? $value : "" ?>">

                            <input type="submit" name="search" value="search">
                        </div>

                    </form>
                </div>

                <div class="list_content">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>id</th>
                                <th>semester</th>
                                <th>title</th>
                                <th>supervisor</th>
                                <th>credit</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>name</th>
                                <th>id</th>
                                <th>semester</th>
                                <th>title</th>
                                <th>supervisor</th>
                                <th>credit</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (!isset($_POST['search'])) {
                                $sql = "SELECT * FROM students  ORDER BY title ASC";
                                $query = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="student_details.php?stuID=<?php echo $row['id'] ?>">
                                                    <?php echo $row['name'] ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $row['id'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['semester'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['title'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['supervisor'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['credit'] ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } else {
                                if (!empty($_POST['search_option']) && !empty($_POST['value'])) {
                                    $search_option = $_POST['search_option'];
                                    $value = htmlspecialchars($_POST['value']);

                                    $sql = "SELECT * FROM students WHERE $search_option LIKE '%$value%' ORDER BY $search_option ASC";
                                    $query = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="student_details.php?stuID=<?php echo $row['id'] ?>">
                                                        <?php echo $row['name'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $row['id'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['semester'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['title'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['supervisor'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['credit'] ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
    </script>

    <script src="https://cdn.datatables.net/autofill/2.5.1/js/dataTables.autoFill.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                order: [
                    [2, 'asc']
                ],
                "pageLength": 25
            });
        });
    </script>

    <script src="../js/nav.js"></script>
    <script src="../js/navSlider.js"></script>

</body>

</html>