<?php
if (isset($_SESSION['sv_id'])) {
    $sv_uid = $_SESSION['sv_id'];
    $sql_nav = "select name, sName from supervisor where email='$sv_uid'";
    $query_nav = mysqli_query($conn, $sql_nav);

    while ($row = mysqli_fetch_array($query_nav)) {
        $sv_name = $row['name'];
        $sv_short_name = $row['sName'];
    }



} else {
    header("Location: supervisor_login.php");
}
?>

<div class="side_nav" id="sideNav">

    <div class="nav_content">
        <div class="about">
            <div class="profile_pic">
                <img src="../supervisor_imgs/supervisor.png" alt="">
            </div>
            <div class="name">
                <h2>
                    <?php echo $sv_name ?>
                </h2>
                <p>supervisor</p>
            </div>
        </div>

        <div class="dashbord">
            <ul>
                <li>
                    <a href="supervisor_profile.php"
                        class="<?php echo $page === 'supervisor_profile' ? 'active' : ''; ?>">dashboard</a>
                </li>
                <li>
                    <a href="sv_thesis_project_list.php"
                        class="<?php echo $page === 'sv_thesis_project_list' ? 'active' : ''; ?>">thesis/project
                        list</a>
                </li>
                <li><a href="my_students.php" class="<?php echo $page === 'my_students' ? 'active' : ''; ?>">my
                        students</a></li>
                <!-- <li><a href="project_list.php">project list</a></li> -->
                <li><a href="marks_input.php" class="<?php echo $page === 'marks_input' ? 'active' : ''; ?>">marks
                        input</a></li>
                <li><a href="marks_input_manually.php" class="<?php echo $page === 'manually' ? 'active' : ''; ?>">marks
                        input manually</a></li>
                <li><a href="upload_report.php" class="<?php echo $page === 'uploadReport' ? 'active' : ''; ?>">
                        upload report</a></li>
                <li><a href="#" class="<?php echo $page === 'account' ? 'active' : ''; ?>">account setting</a></li>
                <li><a href="sv_logout.php">log out</a></li>

            </ul>
        </div>
    </div>

</div>