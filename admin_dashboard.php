<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin_dashboard.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Dashboard</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
        <?php
            include("conn.php");
            $user_id=$_SESSION['mySession'];
            $sql = "SELECT*FROM admin WHERE id='$user_id'" ;
            $result = mysqli_query($con,$sql);

            while ($row=mysqli_fetch_array($result)) {
                echo '<div class="col">';
                echo '<h2>Welcome, '.$row['name'].'</h2>';
                $currentDateTime = new DateTime('now');
                $currentDate = $currentDateTime->format('l, F j, Y');
                echo $currentDate;
                echo '</div>';
            }
        ?>  
        </div>
        <div class="user_info-container">
            <div class="user_info-header">
                <div class="user_info-col">
                    <div class="user_info-row">
                    <h2>Information</h2>
                    <?php
                        include("conn.php");
                        $user_id=$_SESSION['mySession'];
                        $sql = "SELECT*FROM admin WHERE id='$user_id'" ;
                        $result = mysqli_query($con,$sql);
                
                        while ($row=mysqli_fetch_array($result)){
                            echo '<div id="box1">';
                            echo '<div class="row">';
                            echo '<p class="details">User name: '.$row['user_name'].'</p>';
                            echo '<p class="details"> Name: '.$row['name'].'</p>';
                            echo '<p class="details">IC Number: '.$row['ic_number'].'</p>';
                            echo '<p class="details">Email: '.$row['user_email'].'</p>';
                            echo '</div>';
                        }
                    ?>
                    </div> 
                </div>
                <div class="user_info-row right">
                    <?php
                        include("conn.php");
                        $user_id=$_SESSION['mySession'];
                        $sql = "SELECT*FROM admin WHERE id='$user_id'" ;
                        $result = mysqli_query($con,$sql);
                
                        while ($row=mysqli_fetch_array($result)){
                            echo '<div class="row">';
                            echo '<p class="details">Phone Number: '.$row['user_phone'].'</p>';
                            echo '<p class="details">Gender: '.$row['gender'].'</p>';
                            echo '<p class="details">Age: '.$row['user_age'].'</p>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="appointment-container">
            <div class="appointment-header">
                <div class="appointment-col lightgreen">
                    <h3><a href="user_list.php">Users</a></h3>               
                </div>
                <div class="appointment-col lightblue">
                    <h3><a href="admin_list.php">Admins</a></h3>               
                </div>
                <div class="appointment-col lightred">
                    <h3><a href="confirmed_appointments.php">Confirmed Appointments</a></h3>
                </div>
                <div class="appointment-col lightgreen">
                    <h3><a href="add_service.php">Add Service</a></h3>
                </div>
                <div class="appointment-col lightred">
                    <h3><a href="user_registration.php">Register User</a></h3>
                </div>
                <div class="appointment-col lightgreen">
                    <h3><a href="admin_registration.php">Register Admin</a></h3>
                </div>
                <div class="appointment-col lightblue">
                    <h3><a href="cash_payment_request.php">Cash Payment Request</a></h3>
                </div>
                <div class="appointment-col lightred">
                    <h3><a href="monthly_report.php">Generate Report</a></h3>
                </div>
                <div class="appointment-col lightblue">
                    <h3><a href="view_feedback.php">Feedbacks</a></h3>
                </div>
                <div class="appointment-col lightred">
                    <h3><a href="view_vehicles.php">Vehicles</a></h3>
                </div>
                <div class="appointment-col lightgreen">
                    <h3><a href="view_service.php">Services</a></h3>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>