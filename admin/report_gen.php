<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>

<?php
use PhpOffice\PhpSpreadsheet\Style\Supervisor;

require_once '../partials/db_connection.php';
$page = 'report_gen';

$batch = '0';
$semester = '0';
$ex_session = '0';

if (isset($_POST['filter'])) {
    if (!empty($_POST['semester']) && !empty($_POST['ex_session'])) {
        $semester = $_POST['semester'];
        $ex_session = $_POST['ex_session'];

        // echo $batch."\n";
        // echo $semester."\n";
        // echo $ex_session."\n";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>genarate report</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/report_gen.css">

</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1>
                        <i class="fa-solid fa-square-caret-right" id="side_arow"></i>
                        report
                    </h1>
                </div>

                <div class="list_content">

                    <div class="filter">
                        <form action="report_gen.php" method="POST">
                            <div class="filter_option">


                                <select name="semester" id="">
                                    <option value="0">select semester</option>
                                    <?php
                                    for ($i = 1; $i <= 13; $i++) {
                                    ?>
                                    <option value="<?php echo $i ?>" <?php echo $semester == $i ? 'selected' : '' ?>>
                                        <?php echo $i ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>

                                <select name="ex_session" id="">
                                    <option value="0">select exam session</option>
                                    <?php
                                    $c_year = date('Y');
                                    for ($i = $c_year; $i >= 2012; $i--) {
                                    ?>
                                    <option value="<?php echo "spring-" . $i ?>" <?php echo $ex_session == "spring-" . $i ? 
                                            'selected' : '' ?>>
                                        <?php echo "spring-" . $i ?>
                                    </option>
                                    <option value="<?php echo "summer-" . $i ?>" <?php echo $ex_session == "summer-" . $i ? 
                                            'selected' : '' ?>>
                                        <?php echo "summer-" . $i ?>
                                    </option>
                                    <option value="<?php echo "fall-" . $i ?>" <?php echo $ex_session == "fall-" . $i ? 
                                            'selected' : '' ?>>
                                        <?php echo "fall-" . $i ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit" name="filter" value="search">
                            </div>

                        </form>
                    </div>

                    <div class="export_btns">
                        <button onclick="ExportToExcel('xlsx')">excel</button>
                        <button id="btnExport" onclick="Export()">pdf</button>
                    </div>

                    <table id="tbl_exporttable_to_xls">
                        <thead>
                            <tr>
                                <th>teacher</th>
                                <th>student id</th>
                                <th>title</th>
                                <!-- <th>catagory</th> -->
                                <th>credit</th>
                                <!-- <th>total credit</th> -->
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            // $sql = "SELECT * FROM thesis_project_info ORDER BY sv_id";
                            // $query = mysqli_query($conn, $sql);
                            
                            $sql = "SELECT rs.supervisor, st.id, st.title, rs.credit FROM students st 
                            INNER JOIN 
                            result rs on st.id = rs.id where 
                            rs.semester = '$semester' and 
                            rs.exam = '$ex_session'
                            ORDER BY st.supervisor ASC";
                            $query = mysqli_query($conn, $sql);

                            // var_dump(mysqli_fetch_assoc($query));
                            

                            if (mysqli_num_rows($query) > 0) {
                                $last = '';
                                while ($row = mysqli_fetch_array($query)) {
                                    $id = $row['id'];
                                    $supervisor = $row['supervisor'];
                                    $title = $row['title'];
                                    $credit = $row['credit'];

                                    // var_dump($row);
                                    // echo "<br><br>";
                            
                                    if ($supervisor !== $last) {
                                        $sql2 = "SELECT * FROM students WHERE supervisor = '$supervisor' AND semester = '$semester'";
                                        $query2 = mysqli_query($conn, $sql2);
                                        $span = mysqli_num_rows($query2);
                            ?>
                            <tr>
                                <td rowspan="<?php echo $span ?>"><?php echo $supervisor; ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $credit; ?></td>
                            </tr>
                            <?php
                                        $last = $supervisor;
                                    } else {
                            ?>
                            <tr>
                                <!-- <td><?php echo "&nbsp"; ?></td> -->
                                <td><?php echo $id; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $credit; ?></td>
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
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
    </script>

    <script>
    const date = new Date();

    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    let today = day + '/' + month + '/' + year;
    console.log(today);

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
            XLSX.writeFile(wb, fn || (today + '_thesis/project_report.' + (type || 'xlsx')));
    }

    function Export() {
        html2canvas(document.getElementById('tbl_exporttable_to_xls'), {
            onrendered: function(canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download(today + '_thesis/project_report.pdf');
            }
        });
    }
    </script>

    <script src="../js/nav.js"></script>
    <script src="../js/navSlider.js"></script>

</body>

</html>