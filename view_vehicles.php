<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="view_vehicles.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Vehicles</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Registered Vehicles</h2>
            </div>
        </div>
        <div class="vehicle-container">
            <div class="vehicle-header">
                <table>
                    <tr>
                        <th>Number Plate</th>
                        <th>Vehicle Color</th>
                        <th>Registration Number</th>
                        <th>Registration Date</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $user_id = $_SESSION['mySession'];
                    $sql = "SELECT * FROM  vehicle";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['vehicle_number'].'</td>';
                                echo '<td>'.$row['vehicle_color'].'</h5></td>';
                                echo '<td>'.$row['registration_number'].'</td>';
                                echo '<td>'.$row['registration_date'].'</td>';
                            echo '</tr>';
                        }
                    }

                    else {
                        echo '<td colspan = "8"; style="text-align: center;">No vehicles found!</td>';
                    }
                    ?>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>