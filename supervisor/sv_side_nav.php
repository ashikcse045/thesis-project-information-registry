<?php
    if(isset($_SESSION['sv_id']))
    {
        $sv_uid = $_SESSION['sv_id'];
        $sql = "select sv_name from sv_table where sv_email='$sv_uid'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        
        $sv_name = $row['sv_name'];
        
        
    }
    else{
        header("Location: supervisor_login.php");
    }
?>

<div class="side_nav">
            
            <div class="nav_content">
                <div class="about">
                    <div class="profile_pic">
                        <img src="../supervisor_imgs/supervisor.png" alt="">
                    </div>
                    <div class="name">
                        <h2><?php echo $sv_name ?></h2>
                        <p>supervisor</p>
                    </div>
                </div>
    
                <div class="dashbord">
                    <ul>
                        <li><a href="supervisor_profile.php">thesis list</a></li>
                        <li><a href="project_list.php">project list</a></li>
                        <li><a href="register.php">register new</a></li>
                        <li><a href="#">account setting</a></li>
                        <li><a href="sv_logout.php">log out</a></li>
                        
                    </ul>
                </div>
            </div>

        </div>