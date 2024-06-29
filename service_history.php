<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="service_history.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Service History</title>
</head>
<body>
    <?php
        include ("dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Service History</h2>
            </div>
        </div>
        <div class="service-history-container">
            <div class="service-history-header">
                <table>
                    <tr>
                        <th>Service ID</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $user_id = $_SESSION['mySession'];
                    $sql = "SELECT * FROM  appointment INNER JOIN service on appointment.service_id = service.service_id WHERE user_id = $user_id";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['service_id'].'</td>';
                                echo '<td>'.$row['service'].'</h5></td>';
                                echo '<td>'.$row['price'].'</td>';
                                echo '<td>'.$row['service_date'].'</td>';                    
                            echo '</tr>';
                        }
                    }

                    else {
                        echo '<td colspan = "8"; style="text-align: center;">No history!</td>';
                    }

                    ?>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>