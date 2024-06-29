<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="dashboard_nav.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div>
    <?php       
        include("conn.php");
        $user_id=$_SESSION['mySession'];
        $sql = "SELECT*FROM users WHERE id='$user_id'" ;
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
            echo '<a href="dashboard.php"><i class="bx bxs-dashboard"></i>Dashboard</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a href="view_appointment.php"><i class="bx bx-calendar"></i>Appointments</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a href="service_history.php"><i class="bx bx-history"></i>Service History</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a href="vehicle_registration.php"><i class="bx bxs-car"></i>Vehicle Registration</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a href="view_payment.php"><i class="bx bx-receipt"></i>Payment History</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a href="feedback.php"><i class="bx bxs-comment-edit"></i>Feedback</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a href="userprofile.php"><i class="bx bxs-user-circle"></i>Profile</a>';
            echo '</li>';
            echo '<li class="links">';
            echo '<a href="logout.php"><i class="bx bx-log-out"></i>Logout</a>';
            echo '</li>';
            echo '</ul>';
            echo '</div>';
        echo '</div>';
        }   
    ?>
    </div>
</body>
</html>

