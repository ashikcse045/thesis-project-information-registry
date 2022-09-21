<?php
    if(isset($_SESSION['ad_id']))
    {
        $ad_uid = $_SESSION['ad_id'];
        $sql = "select name from a_d_m_i_n where email='$ad_uid'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        
        $ad_name = $row['name'];
        
        
    }
    else{
        header("Location: admin_login.php");
    }
?>

<div class="side_nav">
            
            <div class="nav_content">
                <div class="about">
                    <div class="profile_pic">
                        <img src="supervisor_imgs/supervisor.png" alt="">
                    </div>
                    <div class="name">
                        <h2><?php echo $ad_name ?></h2>
                        <p>admin</p>
                    </div>
                </div>
    
                <div class="dashbord">
                    <ul>
                        <li><a href="admin.php">thesis list</a></li>
                        <li><a href="admin_project_list.php">project list</a></li>
                        <li><a href="admin_all_list.php">all list</a></li>
                        <li><a href="report_gen.php">genarate report</a></li>
                        <li><a href="supervisor_list.php">supervisor</a></li>
                        <li><a href="add_supervisor.php">add supervisor</a></li>
                        
                        <li><a href="admin_logout.php">log out</a></li>
                        
                    </ul>
                </div>
            </div>

        </div>