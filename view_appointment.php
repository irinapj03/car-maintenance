<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="viewAppointment.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>View Appointment</title>
</head>
<body>
    <?php
        include ("dashboard_nav.php")
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
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Change Appointment</th>
                        <th>Cancel Appointment</th>
                        
                    </tr>
                    <?php
                    include("conn.php");

                    $user_id = $_SESSION['mySession'];
                    $sql = "SELECT * FROM  appointment WHERE user_id = $user_id";
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
                                echo '<td>'.$row['status'].'</td>';

                                $appointment_id = $row['appointment_id'];
                                $sql_payment = "SELECT * FROM payment WHERE appointment_id = $appointment_id";
                                $result_payment = mysqli_query($con, $sql_payment);
                                if (mysqli_num_rows($result_payment) > 0) {
                                    echo '<td>Paid</td>';
                                } else {
                                    echo '<td>';
                                    if ($row['status'] == 'Confirm') {
                                        echo '<a href="payment.php?id=' . $row['appointment_id'] . '"><i class="bx bx-money-withdraw"></i>Pay Here</a>';
                                    } else {
                                        echo '';
                                    }
                                    echo '</td>';
                                }

                                echo '<td>';
                                if ($row['status'] != 'Confirm' && $row['status'] != 'Reject' && $row['status'] != 'Cancelled') {
                                    echo '<a href="edit_appointment.php?id='.$row['appointment_id'].'"><i class="bx bxs-edit"></i>Edit</a>';
                                } else {
                                    echo '';
                                }
                                echo '</td>';

                                echo '<td>';
                                if ($row['status'] != 'Confirm' && $row['status'] != 'Reject' && $row['status'] != 'Cancelled') {
                                    echo "<form action='cancel_appointment.php' method='POST' onsubmit='return myFunction()'>";
                                    echo "<input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>";
                                    echo "<button type='submit' name='cancel' value='Cancel' class='btn'>Cancel</button>";
                                    echo "</form>";
                                } else {
                                    echo '';
                                }
                                echo '</td>';

                            echo '</tr>';
                        
                        }
                    }

                    else {
                        echo '<td colspan = "10; style="text-align: center;">No bookings!</td>';
                    }

                    ?>
                </table>  
                <script>
                    function myFunction() {
                        if (confirm("Are you sure you want to cancel this appointment?")) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
                <a href="appointment.php"><button class="appointment-btn">New Appointment</button></a>  
            </div>
        </div>
    </div>
</body>
</html>