
<?php
    include 'conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $id= $_POST['appointment_id'];
        $sql = "DELETE FROM appointment WHERE appointment_id = ?";
        
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script type='text/javascript'>alert('Appointment cancelled.'); window.location.href='view_appointment.php';</script>";
            } else {
                echo "Error: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
    mysqli_close($con);
?>



