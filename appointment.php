<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="appointment.css" rel="stylesheet">
    <title>Appointment</title>
</head>
<body>
    <div class="appointment-row">
        <div class="image">
            <div class="image-overlay">
                <?php
                    include("navbar1.php");
                ?>
                <div class="wrapper-col-header">
                    <h1 class="slide-left" style="padding: 1.5rem; max-width: 1300px" >Book Your Appointment Now!</h1>
                    <p class="slide-left" style="margin-left: 4%; max-width: 600px">Book your Repair 4U appointment now! Don't delay and let our experts fix it fast. Contact us today!</p>
                </div>
                <div class="wrapper-col">
                    <form method="post">
                        <h2>Book An Appointment</h2>
                        <div class="input-box">
                            <input type="text" placeholder="First Name" name="first_name" required>
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Last Name" name="last_name" required>
                        </div>
                        <div class="input-box">
                            <input type="number" placeholder="Phone Number" name="phone_number"  required>
                        </div>
                        <div class="input-box">
                            <select name="service" id="service">
                            <option value="" disable selected>Select Service</option>
                            <?php
                                include ("conn.php");
                                $sql = "SELECT * FROM service";
                                $result = mysqli_query($con, $sql);

                                if(mysqli_num_rows($result) > 0 ) {
                                    while ($row=mysqli_fetch_assoc($result)) {
                                        echo '<option>'.$row['service_type'].'</option>';
                                    }
                                }
                            ?>
                            
                            </select>
                        </div>
                        <div class="input-box">
                            <input type="date"  name="date" required>
                        </div>
                        <div class="input-box">
                            <select id="service" name="time">
                            <option value=" ">Select Time</option>
                                <option value="11a.m - 12.30p.m">11a.m - 12.30p.m</option>
                                <option value="12.30p.m - 2p.m">12.30p.m - 2p.m</option>
                                <option value="2p.m - 3.30p.m">2p.m - 3.30p.m</option>
                                <option value="3.30p.m - 5p.m">3.30p.m - 5p.m</option>
                            </select>
                        </div>
                        <button name="submitBtn" type="submit" class="btn">Submit</button>'
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("conn.php");
    
    if(isset($_POST['submitBtn'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone_number'];
        $service = $_POST['service'];
        $service_date = $_POST['date'];
        $service_time = $_POST['time'];
        $user_id = $_SESSION['mySession'];
        
        $sql = "SELECT service_id FROM service WHERE service_type = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $service);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $service_id);
        

        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

       
        $sql2 = "INSERT INTO appointment (first_name, last_name, phone_number, service, service_id, service_date, service_time, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($con, $sql2);
        mysqli_stmt_bind_param($stmt2, "ssissssi", $first_name, $last_name, $phone, $service, $service_id, $service_date, $service_time, $user_id);
        mysqli_stmt_execute($stmt2);
        $check = mysqli_stmt_affected_rows($stmt2);
        
        $appointment_id = mysqli_insert_id($con);

        if($check > 0) {
            echo '<script>alert("Appointment Successful!");window.location.href="view_appointment.php";</script>'; 
        } else {
            echo '<script>alert("Failed to book appointment.");</script>';
        }
    }
?>

        
</body>
</html>