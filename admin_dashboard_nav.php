<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin_dashboard_nav.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div>
    <?php       
        include("conn.php");
        $user_id=$_SESSION['mySession'];
        $sql = "SELECT*FROM admin WHERE id='$user_id'" ;
        $result = mysqli_query($con,$sql);
        $user_icon = "logo1.png";
    
        echo '<div class="container">';
        while ($row=mysqli_fetch_array($result)){
            echo '<div class="wrapper">';
            echo '<div class="wrapper-col">';
            echo '<img src="logo1.png""'.$user_icon.'" width="100">';
            echo '</div>';
            echo '<div class="wrapper-col">';
            echo '<h3>'.$row['user_name'].'</h3>';
            echo '</div>';
            echo '<div class="wrapper-col">';
            echo '<p>'.$row['name'].'</p>';
            echo '</div>';
            echo '<ul class="wrapper-link">';
            echo '<li class="links">';
            echo '<a class="edit" href="admin_dashboard.php"><i class="bx bxs-dashboard"></i>Dashboard</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a class="edit" href="admin_appointment.php"><i class="bx bx-calendar"></i>Appointment Requests</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a class="edit" href="payment_list.php"><i class="bx bx-history"></i>Payments</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a class="edit" href="adminprofile.php"><i class="bx bxs-user-circle"></i>Profile</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a class="edit" href="logout.php"><i class="bx bx-log-out"></i>Logout</a>';
            echo '</li>';
            echo '</ul>';
            echo '</div>';
        echo '</div>';
        }   
    ?>
    </div>
</body>
</html>

