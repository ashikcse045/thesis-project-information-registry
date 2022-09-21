<?php
    session_start();
    unset($_SESSION['sv_id']);
    header("Location: supervisor_login.php");
?>