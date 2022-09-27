<script>
    if ( window.history.replaceState ) {
     window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
require_once '../partials/db_connection.php';

$batch = '0';
$semester = '0';
$ex_session = '0';

if(isset($_POST['filter']))
{
    if(!empty($_POST['batch']) && !empty($_POST['semester']) && !empty($_POST['ex_session']))
    {
        $batch = $_POST['batch'];
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


    <link rel="stylesheet" href="../fontawesome-6/css/all.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/supervisor.css">
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
                    <h1>report</h1>
                </div>

                <div class="list_content">

                    <div class="filter">
                        <form action="report_gen.php" method="POST">
                            <div class="filter_option">
                                <select name="batch" id="">
                                    <option value="0">select batch</option>
                                    <?php
                                        for($i = 1; $i <= 50; $i++)
                                        {
                                            ?>
                                            <option value="<?php echo $i ?>" <?php echo $batch==$i ? 'selected' : '' ?>><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>

                                <select name="semester" id="">
                                    <option value="0">select semester</option>
                                    <?php
                                        for($i = 1; $i <= 13; $i++)
                                        {
                                            ?>
                                            <option value="<?php echo $i ?>" <?php echo $semester==$i ? 'selected' : '' ?>><?php echo $i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>

                                <select name="ex_session" id="">
                                    <option value="0">select exam session</option>
                                    <?php
                                        $c_year = date('Y');
                                        for($i = $c_year; $i >= 2012; $i--)
                                        {
                                            ?>
                                            <option value="<?php echo "spring-".$i ?>" <?php echo $ex_session=="spring-".$i ? 'selected' : '' ?>><?php echo "spring-".$i ?></option>
                                            <option value="<?php echo "summer-".$i ?>" <?php echo $ex_session=="summer-".$i ? 'selected' : '' ?>><?php echo "summer-".$i ?></option>
                                            <option value="<?php echo "fall-".$i ?>" <?php echo $ex_session=="fall-".$i ? 'selected' : '' ?>><?php echo "fall-".$i ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <input type="submit" name="filter" value="filter">
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
                                <th>catagory</th>
                                <th>credit</th>
                                <th>total credit</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            // $sql = "SELECT * FROM thesis_project_info ORDER BY sv_id";
                            // $query = mysqli_query($conn, $sql);

                            $sql = "SELECT * FROM thesis_project_info tp inner join sv_table sv on tp.sv_ref = sv.sv_email where tp.batch = '$batch' and tp.semester = '$semester' and end_session = '$ex_session'";
                            $query = mysqli_query($conn, $sql);


                            if (mysqli_num_rows($query) > 0) {
                                $last = '';
                                while ($row = mysqli_fetch_array($query)) {
                                    $teacher_ref = $row['sv_ref'];
                                    $now = $teacher_ref;
                                    if ($now != $last) {
                                        $sql2 = "select * from thesis_project_info where sv_ref = '$teacher_ref' and batch = '$batch' and semester = '$semester' and end_session = '$ex_session'";
                                        $query2 = mysqli_query($conn, $sql2);
                                        $count = mysqli_num_rows($query2);

                                        $c = 1;
                                        $total_credit = 0;
                                        $query3 = mysqli_query($conn, $sql2);
                                        while ($test = mysqli_fetch_array($query3)) {
                                            $total_credit = $total_credit + (int)$test['credit'];
                                        }

                                        while ($row2 = mysqli_fetch_array($query2)) {


                                            if ($c === 1) {
                                                
                            ?>
                                                <tr>
                                                    <td rowspan="<?php echo $count ?>"> <?php echo $row["sv_name"] ?> </td>

                                                    <td> <?php echo $row2['stu_id'] ?> </td>
                                                    <td> <?php echo $row2['title'] ?> </td>
                                                    <td> <?php echo $row2['catagory'] ?> </td>
                                                    <td> <?php echo $row2['credit'] ?> </td>


                                                    <td rowspan="<?php echo $count ?>"> <?php echo $total_credit; ?> </td>
                                                </tr>
                            <?php
                                                $c++;
                                            } else {
                                            ?>
                                                <tr>
                                                    <td> <?php echo $row2['stu_id'] ?> </td>
                                                    <td> <?php echo $row2['title'] ?> </td>
                                                    <td> <?php echo $row2['catagory'] ?> </td>
                                                    <td> <?php echo $row2['credit'] ?> </td>
                                                </tr>
                            <?php
                                            }
                                        }
                                    }
                                    $last = $teacher_ref;
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

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    
    <script>
        const date = new Date();

        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();

        let today = day+'/'+month+'/'+year;
        console.log(today);
        function ExportToExcel(type, fn, dl) 
        {
        var elt = document.getElementById('tbl_exporttable_to_xls');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
        return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || (today+'_thesis/project report.' + (type || 'xlsx')));
        }
        function Export() {
            html2canvas(document.getElementById('tbl_exporttable_to_xls'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download(today+'_thesis/project report.pdf');
                }
            });
        }
    </script>

</body>

</html>