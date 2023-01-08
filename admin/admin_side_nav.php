<?php
if (isset($_SESSION['ad_id'])) {
    $ad_uid = $_SESSION['ad_id'];
    $sql = "select name from admin where email='$ad_uid'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);

    $ad_name = $row['name'];


} else {
    header("Location: admin_login.php");
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
                    <?php echo $ad_name ?>
                </h2>
                <p>admin</p>
            </div>
        </div>

        <div class="dashbord">
            <ul>
                <li><a href="admin_profile.php"
                        class="<?php echo $page === 'admin_profile' ? 'active' : ''; ?>">dashboard</a></li>

                <li><a href="admin_all_list.php" class="<?php echo $page === 'all_list' ? 'active' : ''; ?>">all
                        list</a>
                </li>
                <!-- <li><a href="admin_thesis_list.php">thesis list</a></li> -->
                <!-- <li><a href="admin_project_list.php">project list</a></li> -->

                <li><a href="students.php" class="<?php echo $page === 'students' ? 'active' : ''; ?>">supervisor
                        student's</a></li>

                <li><a href="report_gen.php" class="<?php echo $page === 'report_gen' ? 'active' : ''; ?>">genarate
                        report</a>
                </li>
                <li><a href="supervisor_assign.php"
                        class="<?php echo $page === 'supervisor_assign' ? 'active' : ''; ?>">supervisor
                        assign</a></li>

                <li><a href="map_credit.php" class="<?php echo $page === 'map_credit' ? 'active' : ''; ?>">map
                        credit</a></li>
                <li><a href="result_publish.php"
                        class="<?php echo $page === 'result_publish' ? 'active' : ''; ?>">publish
                        result</a></li>

                <li><a href="supervisor_list.php"
                        class="<?php echo $page === 'supervisor_list' ? 'active' : ''; ?>">supervisor
                        list</a></li>
                <li><a href="add_supervisor.php" class="<?php echo $page === 'add_supervisor' ? 'active' : ''; ?>">add
                        supervisor</a></li>

                <li><a href="admin_logout.php" class="<?php echo $page === 'home' ? 'active' : ''; ?>">log out</a></li>

            </ul>
        </div>
    </div>

</div>