<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="user_list.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Users</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Users</h2>
            </div>
        </div>
        <div class="user-container">
            <div class="user-header">
                <table>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>IC Number</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $user_id = $_SESSION['mySession'];
                    $sql = "SELECT * FROM  users";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['id'].'</td>';
                                echo '<td>'.$row['user_name'].'</h5></td>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.$row['ic_number'].'</td>';
                                echo '<td>'.$row['user_email'].'</td>';
                                echo '<td>'.$row['user_phone'].'</td>';
                            echo '</tr>';
                        }
                    }

                    else {
                        echo '<td colspan = "8"; style="text-align: center;">No users found!</td>';
                    }

                    ?>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>