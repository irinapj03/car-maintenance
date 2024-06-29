<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="dashboard.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Dashboard</title>
</head>
<body>
    <?php
        include ("dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
        <?php
            include("conn.php");
            $user_id=$_SESSION['mySession'];
            $sql = "SELECT*FROM users WHERE id='$user_id'" ;
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
                        $sql = "SELECT*FROM users WHERE id='$user_id'" ;
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
                        $sql = "SELECT*FROM users WHERE id='$user_id'" ;
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
        <div class="vehicle-container">
            <div class="vehicle-header">
                <h2>Vehicle Registration</h2>
                <table>
                    <tr>
                        <th>Vehicle Number</th>
                        <th>Color</th>
                        <th>Registration Number</th>
                        <th>Registration Date</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $user_id = $_SESSION['mySession'];
                    $sql = "SELECT * FROM vehicle WHERE user_id = $user_id";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_array($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['vehicle_number'].'</td>';
                                echo '<td>'.$row['vehicle_color'].'</h5></td>';
                                echo '<td>'.$row['registration_number'].'</td>';
                                echo '<td>'.$row['registration_date'].'</td>';
                            echo '</tr>';
                        }
                    }

                    else {
                        echo '<td colspan = "5"; style="text-align: center;">No vehicle registered!</td>';
                    }

                    ?>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>