<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'my_students';

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
    if (!empty($_POST['semester'])) {
        $semester = $_POST['semester'];
        // echo $semester;
        if ($semester == 10) {
            $credit = 0;
        } elseif ($semester == 11) {
            $credit = 1;
        } elseif ($semester == 12) {
            $credit = 2;
        }
        $sql = "SELECT * FROM students WHERE semester = '$semester' AND credit = '$credit' AND supervisor = '$sv_short_name'";
        // $sql = "SELECT * FROM students";
        $query = mysqli_query($conn, $sql);

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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/thesis_project_list.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/report_gen.css">

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
                    <form action="my_students.php" method="POST">
                        <div class="filter_option">

                            <select name="semester" id="">
                                <option value="0" <?php if (isset($semester)) {
                                    if ($semester === "0") {
                                        echo "selected";
                                    }
                                } ?>>
                                    select semester
                                </option>
                                <option value="10" <?php if (isset($semester)) {
                                    if ($semester === "10") {
                                        echo
                                            "selected";
                                    }
                                } ?>>
                                    10 th
                                </option>
                                <option value="11" <?php if (isset($semester)) {
                                    if ($semester === "11") {
                                        echo
                                            "selected";
                                    }
                                } ?>>
                                    11 th
                                </option>
                                <option value="12" <?php if (isset($semester)) {
                                    if ($semester === "12") {
                                        echo "selected";
                                    }
                                } ?>>
                                    12 th
                                </option>
                            </select>

                            <!-- <input type="text" name="value" value="<?php echo isset($value) ? $value : "" ?>"> -->

                            <input type="submit" name="search" value="search">
                        </div>

                    </form>
                </div>

                <div class="list_content">
                    <div class="export_btns">
                        <button onclick="ExportToExcel('xlsx')">export xlsx</button>
                        <!-- <button id="btnExport" onclick="Export()">pdf</button> -->
                    </div>
                    <table id="tbl_exporttable_to_xls">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>id</th>
                                <th>name</th>
                                <th>semester</th>
                                <th>title</th>
                                <th>result</th>
                                <th>credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($query) > 0) {
                                $temp = 1;
                                while ($row = mysqli_fetch_array($query)) {
                                    // $id = $row['id'];
                                    // $name = $row['name'];
                                    // $semester = $row['semester'];
                                    // $title = $row['title'];
                                    // print_r($row);
                                    // echo "<br>";
                                    // echo "<br>";
                            
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $temp;
                                            $temp++; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['semester'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['title'] ?>
                                        </td>
                                        <td>
                                            <?php echo "0" ?>
                                        </td>
                                        <td>
                                            <?php echo $row['credit'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<script>alert('no data found')</script>";
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

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
    </script>

    <script>
        let semester = '<?php echo isset($semester) ? $semester : "no"; ?>';
        let fileName = semester + '_Semester_Students';

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('tbl_exporttable_to_xls');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || (fileName + '.' + (type || 'xlsx')));
        }

    // function Export() {
    //     html2canvas(document.getElementById('tbl_exporttable_to_xls'), {
    //         onrendered: function(canvas) {
    //             var data = canvas.toDataURL();
    //             var docDefinition = {
    //                 content: [{
    //                     image: data,
    //                     width: 500
    //                 }]
    //             };
    //             pdfMake.createPdf(docDefinition).download(today + '_thesis/project report.pdf');
    //         }
    //     });
    // }
    </script>


</body>

</html>