<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="view_service.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>View Service</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>View Service</h2>
            </div>
        </div>
        <div class="service-container">
            <div>
                <?php
                    include ("conn.php");
                    $sql = "SELECT * FROM service";
                    $result = mysqli_query($con, $sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                
                            echo '<div class="service-header">';
                                echo '<div class="service-col">';
                                    echo '<h3>'.$row['service_type'].'</h3>';
                                    echo '<p class="description">'.$row['service_description'].'</p>';
                                    echo '<p class="description">Price: '.$row['price'].'</p>';
                                    echo '<div class="edit-service">';
                                        echo '<a href="edit_service.php?id='.$row['service_id'].'"><i class="bx bxs-edit"></i>Edit</a>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
            <a href="add_service.php" ><button class="btn">Add Service</button></a>
        </div>
    </div>
</body>
</html>