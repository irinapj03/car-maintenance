<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="confirmed_appointments.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Appointments Status</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Appointment Status</h2>
            </div>
        </div>
        <div class="appointment-container">
            <div class="appointment-header">
                <table>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Service Date</th>
                        <th>Service Time</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $user_id = $_SESSION['mySession'];
                    $sql = "SELECT * FROM  appointment WHERE status = 'Confirm'";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['appointment_id'].'</td>';
                                echo '<td>'.$row['first_name'].'</h5></td>';
                                echo '<td>'.$row['phone_number'].'</td>';
                                echo '<td>'.$row['service_date'].'</td>';
                                echo '<td>'.$row['service_time'].'</td>';
                                echo '<td>'.$row['status'].'</td>';
                            echo '</tr>';
                        
                        }
                    }

                    else {
                        echo '<td colspan = "8"; style="text-align: center;">No appointments found!</td>';
                    }

                    ?>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>