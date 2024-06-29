<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="view_feedback.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Feedback Lists</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Feedbacks</h2>
            </div>
        </div>
        <div class="feedback-container">
            <div class="feedback-header">
                <table>
                    <tr>
                        <th>Feedback ID</th>
                        <th>Customer</th>
                        <th>Message</th>
                        <th>Timestamp</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $sql = "SELECT * FROM  feedback";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['feedback_id'].'</td>';
                                echo '<td>'.$row['name'].'</h5></td>';
                                echo '<td>'.$row['message'].'</td>';
                                echo '<td>'.$row['timestamp'].'</td>';
                            echo '</tr>';
                        
                        }
                    }

                    else {
                        echo '<td colspan = "8"; style="text-align: center;">No feedback found</td>';
                    }

                    ?>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>