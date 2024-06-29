<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vehicle_registration.css" rel="stylesheet">
    <title>Vehicle Registration</title>
</head>
<body>
    <div class="image">
        <div class="image-overlay">
            <?php
                include("navbar1.php");
            ?>
            <div class="wrapper-col">
                <form method="post">
                    <h2>Vehicle Registration</h2>
                    <div class="input-box">
                        <input type="text" placeholder="Vehicle Number" name="vehicle_number" required>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Vehicle Color" name="color" required>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Registration Number" name="reg_num" required>
                    </div>
                    <div class="input-box">
                        <input type="date" placeholder="Registration Date" name="reg_date"  required>
                    </div>
                    <div class="input-box">
                        <select name="vehicle_type">
                            <option value="" disable selected>Select vehicle type</option>
                            <option>Sedan</option>
                            <option>SUV</option>
                            <option>MPV</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <select name="area">
                            <option value="" disable selected>Select Area</option>
                            <option>Kuala Lumpur</option>
                            <option>Petaling Jaya</option>
                            <option>Subang Jaya</option>
                        </select>
                    </div>
                    <button name="submitBtn" type="submit" class="btn">Submit</button>
                    <button type="reset" class="btn">Reset</button>
                </form>
            </div>
        </div>
    </div>
    

    <?php
        include("conn.php");

        if(isset($_POST['submitBtn'])) {
           $number = $_POST['vehicle_number'];
           $color = $_POST['color'];
           $reg_num = $_POST['reg_num'];
           $reg_date = $_POST['reg_date'];
           $type = $_POST['vehicle_type'];
           $area = $_POST['area'];
           $user_id = $_SESSION['mySession'];

            $sql = "INSERT INTO vehicle (vehicle_number, vehicle_color, registration_number, registration_date, vehicle_type, area, user_id) VALUES ('$number', '$color', '$reg_num', '$reg_date','$type', '$area', '$user_id')";
            
            $stmt = mysqli_prepare($con,$sql);
            mysqli_stmt_execute($stmt);
            $check = mysqli_stmt_affected_rows($stmt);
            
            if($check == 1) {
                echo '<script>alert("Vehicle successfully registered!");window.location.href="dashboard.php";</script>'; 
            }

        }
    ?>

</body>
</html>