<?php
require_once '../partials/db_connection.php';

$exam = $_POST['exam'];

$sql = "SELECT stu_id FROM thesis_project_info WHERE end_session = '$exam' ORDER BY stu_id ASC";
$query = mysqli_query($conn, $sql);

$output = '<option value="">select student</option>';

while($row = mysqli_fetch_array($query))
{
    $output .= '<option value="'.$row['stu_id'].'">'.$row['stu_id'].'</option>';
}

echo $output;
?>

