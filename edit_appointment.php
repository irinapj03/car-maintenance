<?php
    include 'conn.php';

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo "Error: Appointment ID is missing or invalid.";
        exit;
    }
    
    $id = $_GET['id']; 

    $result = mysqli_query($con, "SELECT * FROM appointment WHERE appointment_id = $id");

    if ($result === false) {
        echo "Error: " . mysqli_error($con);
    } else {
        $row = mysqli_fetch_assoc($result);
    }

    try {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone_number'];
            $service = $_POST['service'];
            $service_date = $_POST['date'];
            $service_time = $_POST['service_time'];
            $id = $_POST['appointment_id'];

            $sql_service = "SELECT service_id FROM service WHERE service_type = ?";
            $stmt_service = mysqli_prepare($con, $sql_service);
            mysqli_stmt_bind_param($stmt_service, "s", $service);
            mysqli_stmt_execute($stmt_service);
            mysqli_stmt_bind_result($stmt_service, $service_id);
            mysqli_stmt_fetch($stmt_service);
            mysqli_stmt_close($stmt_service);

            $stmt = mysqli_prepare($con, "UPDATE appointment SET first_name = ?, last_name = ?, phone_number = ?, service = ?, service_id = ?, service_date = ?, service_time = ? WHERE appointment_id = ?");

            if ($stmt === false) {
                throw new Exception("Error in preparing the statement: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "ssssissi", $first_name, $last_name, $phone, $service, $service_id, $service_date, $service_time, $id);

            $result = mysqli_stmt_execute($stmt);

            if ($result === false) {
                throw new Exception("Error in executing the statement: " . mysqli_error($con));
            } else {
                mysqli_stmt_close($stmt);
                header("Location: view_appointment.php");
                exit;
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="appointment.css" rel="stylesheet">
    <title>Edit Appointment</title>
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
                <?php
                include 'conn.php';

                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    echo "Error: Appointment ID is missing or invalid.";
                    exit;
                }
                
                $id = $_GET['id']; 

                $result = mysqli_query($con, "SELECT * FROM appointment WHERE appointment_id = $id");

                if ($result === false) {
                    echo "Error: " . mysqli_error($con);
                } else {
                    $row = mysqli_fetch_assoc($result);
                }

                try {
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $phone = $_POST['phone_number'];
                        $service = $_POST['service'];
                        $service_date = $_POST['date'];
                        $service_time = $_POST['service_time'];
                        $id = $_POST['appointment_id'];

                        $sql_service = "SELECT service_id FROM service WHERE service_type = ?";
                        $stmt_service = mysqli_prepare($con, $sql_service);
                        mysqli_stmt_bind_param($stmt_service, "s", $service);
                        mysqli_stmt_execute($stmt_service);
                        mysqli_stmt_bind_result($stmt_service, $service_id);
                        mysqli_stmt_fetch($stmt_service);
                        mysqli_stmt_close($stmt_service);

                        $stmt = mysqli_prepare($con, "UPDATE appointment SET first_name = ?, last_name = ?, phone_number = ?, service = ?, service_id = ?, service_date = ?, service_time = ? WHERE appointment_id = ?");

                        if ($stmt === false) {
                            throw new Exception("Error in preparing the statement: " . mysqli_error($con));
                        }

                        mysqli_stmt_bind_param($stmt, "ssssisii", $first_name, $last_name, $phone, $service, $service_id, $service_date, $service_time, $id);

                        $result = mysqli_stmt_execute($stmt);

                        if ($result === false) {
                            throw new Exception("Error in executing the statement: " . mysqli_error($con));
                        } else {
                            mysqli_stmt_close($stmt);
                            header("Location: view_appointment.php");
                            exit;
                        }
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            ?>
                <div class="wrapper-col">
                    <form method="post">
                        <h2>Book An Appointment</h2>
                        <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
                        <div class="input-box">
                            <input type="text" placeholder="First Name" name="first_name"  value="<?php echo $row['first_name']?>" required>
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Last Name" name="last_name" value="<?php echo $row['last_name']?>" required>
                        </div>
                        <div class="input-box">
                            <input type="number" placeholder="Phone Number" name="phone_number" value="<?php echo $row['phone_number']?>" required>
                        </div>
                        <div class="input-box">
                        <select name="service" id="service">
                            <option value="">Select Service</option>
                            <?php
                            include("conn.php");
                            $sql = "SELECT * FROM service";
                            $result = mysqli_query($con, $sql);

                            if(mysqli_num_rows($result) > 0) {
                                while ($service_row = mysqli_fetch_assoc($result)) {
                                    $selected = ($service_row['service_type'] == $row['service']) ? 'selected' : '';
                                    echo '<option value="' . $service_row['service_type'] . '" ' . $selected . '>' . $service_row['service_type'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        </div>
                        <div class="input-box">
                            <input type="date" placeholder="Date" name="date" value="<?php echo $row['service_date']?>" required>
                        </div>
                        <div class="input-box">
                            <select name="service_time">
                            <option value="">Select Time</option>
                                <option value="11a.m - 12.30p.m" <?php if ($row['service_time'] == '11a.m - 12.30p.m') echo 'selected';?>>11a.m - 12.30p.m</option>
                                <option value="12.30p.m - 2p.m" <?php if ($row['service_time'] == '12.30p.m - 2p.m') echo 'selected';?>>12.30p.m - 2p.m</option>
                                <option value="2p.m - 3.30p.m" <?php if ($row['service_time'] == '2p.m - 3.30p.m') echo 'selected';?>>2p.m - 3.30p.m</option>
                                <option value="3.30p.m - 5p.m" <?php if ($row['service_time'] == '3.30p.m - 5p.m') echo 'selected';?>>3.30p.m - 5p.m</option>
                            </select>
                        </div>
                        <button name="submitBtn" type="submit" class="btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>