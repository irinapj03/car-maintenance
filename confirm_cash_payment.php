<?php
    include 'conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id= $_POST['payment_id'];
        $status = $_POST['confirm'];

        $sql = "UPDATE payment SET status = ? WHERE payment_id = ?";
        
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'si', $status, $id);

            if (mysqli_stmt_execute($stmt)) {
                if ($status == 'Confirm') {
                    echo "<script type='text/javascript'>alert('Payment confirmed successfully.'); window.location.href='payment_list.php';</script>";
                } 
            } 
            else {
                echo "Error: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
        } 
        
        else {
            echo "Error: " . mysqli_error($con);
        }
    }
?>
