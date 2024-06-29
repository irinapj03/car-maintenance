<?php
    include ("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="add_service.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Edit Service</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Edit Service</h2>
            </div>
        </div>
        <?php
            include ('conn.php');
            

            if (!isset($_GET['id']) || empty($_GET['id'])) {
                echo "Error: Service ID is missing or invalid.";
                exit;
            }
            
            $id = $_GET['id']; 

            $result = mysqli_query($con, "SELECT * FROM service WHERE service_id = $id");

            if ($result === false) {
                echo "Error: " . mysqli_error($con);
            } else {
                $row = mysqli_fetch_assoc($result);
            }

            try {
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $type = $_POST['service_type'];
                    $description = $_POST['service_description'];
                    $price = $_POST['price'];
                    $id = $_POST['service_id'];

                    $stmt = mysqli_prepare($con, "UPDATE service SET service_type = ?, price = ?, service_description = ? WHERE service_id = ?");

                    if ($stmt === false) {
                        throw new Exception("Error in preparing the statement: " . mysqli_error($con));
                    }

                    mysqli_stmt_bind_param($stmt, "sssi", $type, $price, $description, $id);

                    $result = mysqli_stmt_execute($stmt);

                    if ($result === false) {
                        throw new Exception("Error in executing the statement: " . mysqli_error($con));
                    } else {
                        mysqli_stmt_close($stmt);
                        header("Location: view_service.php");
                        exit;
                    }
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
        <div class="service-container">
            <div class="service-header">
                <form method="post">
                    <input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">
                    <div class="input-box">
                        <label>Service Type</label>
                        <input type="text" name="service_type" value="<?php echo $row['service_type']?>"required>
                    </div>
                    <div class="input-box">
                        <label>Service Price</label>
                        <input type="number" name="price" value="<?php echo $row['price']?>" required>
                    </div>
                    <div class="input-box">
                        <label>Service Description</label>
                        <input type="text" name="service_description" value="<?php echo $row['service_description']?>" required></textarea>
                    </div>
                    <button type="submit" name="btn" class="submitBtn">Update Service</buttom>
                </form>

            </div>
        </div>
    </div>
</body>
</html>