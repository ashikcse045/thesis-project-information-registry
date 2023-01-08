<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../partials/db_connection.php';
$page = 'students';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/side_nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/admin_students.css">



</head>

<body>

    <?php require_once '../partials/nav.php' ?>

    <div class="container">

        <?php require_once 'admin_side_nav.php' ?>

        <div class="content">
            <div class="content_box">
                <div class="page_title">
                    <h1><i class="fa-solid fa-square-caret-right" id="side_arow"></i> supervisor students list</h1>
                </div>

                <div class="list_content">

                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>supervisor</th>
                                <th>student id</th>
                                <th>student name</th>
                                <th>section</th>
                                <th>title</th>
                                <th>credit</th>

                            </tr>
                        </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>supervisor</th>
                                <th>student id</th>
                                <th>student name</th>
                                <th>section</th>
                                <th>title</th>
                                <th>credit</th>
                            </tr>
                        </tfoot> -->

                        <tbody>
                            <?php
                            $sql = "SELECT * FROM students ORDER BY credit DESC, title ASC";
                            $query = mysqli_query($conn, $sql);
                            $count = 1;
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $count ?>
                                        </td>
                                        <td>
                                            <?php echo $row['supervisor'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['section'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['title'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['credit'] ?>
                                        </td>
                                    </tr>

                                    <?php
                                    $count++;
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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    {
                        extend: 'excel',
                        text: 'Download Excel',
                        title: ''
                    },
                    'csvHtml5',
                    'pdfHtml5'

                ]
            });
        });

        /*$('#session2').on('change', function(){
            var exam_id = this.value;
            $.ajax({
                url: 'load_data.php',
                type: "POST",
                data: {
                    exam: exam_id
                },
                success: function(result){
                    $('#stu').html(result);
                    console.log(result);
                }
            })
        });*/
    </script>

    <script src="../js/nav.js"></script>
    <script src="../js/navSlider.js"></script>

</body>

</html>