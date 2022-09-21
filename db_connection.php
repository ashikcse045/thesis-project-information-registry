<?php
    $servername = "localhost";
    $username = "root";
    $db_name = "final_project";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db_name);
    session_start();

    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    date_default_timezone_set("Asia/Dhaka");
?>