<?php
require_once '../partials/db_connection.php';
// The location of the PDF file
// on the server
if (isset($_GET['stuId'])) {
    $stuId = $_GET['stuId'];
    $sql = "SELECT * FROM students WHERE id = '$stuId'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        $fileName = $row['report_file'];

        $path = "../uploads/";
        $file = $path . $fileName;

        // Header content type
        header("Content-type: application/pdf");

        header("Content-Length: " . filesize($file));

        // Send the file to the browser.
        readfile($file);


    } else {
        header("Location: error.php");
    }
} else {
    header("Location: error.php");
}

?>