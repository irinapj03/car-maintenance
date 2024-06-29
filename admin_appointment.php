<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="admin_appointment.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Appointment Requests</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Appointment Schedule</h2>
            </div>
        </div>
        <div class="appointment-container">
            <div class="appointment-header">
                <table>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Service Type</th>
                        <th>Service Date</th>
                        <th>Service Time</th>
                        <th>Confirm/Reject</th>
                        <th>Cancel Appointment</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $user_id = $_SESSION['mySession'];
                    $sql = "SELECT * FROM  appointment WHERE status NOT IN ('Confirm', 'Reject', 'Cancelled')";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['appointment_id'].'</td>';
                                echo '<td>'.$row['first_name'].'</h5></td>';
                                echo '<td>'.$row['phone_number'].'</td>';
                                echo '<td>'.$row['service'].'</td>';
                                echo '<td>'.$row['service_date'].'</td>';
                                echo '<td>'.$row['service_time'].'</td>';
                                echo "<td>";
                                echo "<form action='update_appointment.php' method='POST'>";
                                echo "<input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>";
                                echo "<button type='submit' name='status' value='Confirm' class='btn lightgreen'>Confirm</button>";
                                echo "<button type='submit' name='status' value='Reject' class='btn lightred'>Reject</button>";
                                echo "</td>";
                                echo "<td>";
                                echo "<button type='submit' name='status' value='Cancelled' class='btn'>Cancel</button>";
                                echo "</td>";
                                echo "</form>";
                            echo '</tr>';
                        }
                    }

                    else {
                        echo '<td colspan = "8"; style="text-align: center;">No pending appointments!</td>';
                    }

                    ?>
                </table>
                
            </div>
        </div>
    </div>
</body>
</html>