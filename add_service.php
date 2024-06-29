<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="add_service.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Add Service</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Add Service</h2>
            </div>
        </div>
        <div class="service-container">
            <div class="service-header">
                <form method="post">
                    <div class="input-box">
                        <label>Service Type</label>
                        <input type="text" name="service_type" required>
                    </div>
                    <div class="input-box">
                        <label>Service Price</label>
                        <input type="number" name="price" required>
                    </div>
                    <div class="input-box">
                        <label>Service Description</label>
                        <input type="text" name="service_description" required></textarea>
                    </div>
                    <button type="submit" name="btn" class="submitBtn">Add Service</buttom>
                </form>

            </div>
        </div>
    </div>

    <?php
        include("conn.php");

        if(isset($_POST['btn'])) {
            $type = $_POST['service_type'];
            $description = $_POST['service_description'];
            $price = $_POST['price'];

            $sql = "INSERT INTO service (service_type,  price, service_description) VALUES ('$type', '$price', '$description')";
            
            $stmt = mysqli_prepare($con,$sql);
            mysqli_stmt_execute($stmt);
            $check = mysqli_stmt_affected_rows($stmt);
            
            if($check == 1) {
                echo '<script>alert("Successfully added!");window.location.href="view_service.php";</script>'; 
            }

        }
    ?>

</body>
</html>