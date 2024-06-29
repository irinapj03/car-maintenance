<?php
    include ("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="feedback.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Feedback</title>
</head>
<body>
    <?php
        include ("dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Feedback</h2>
            </div>
        </div>
        <div class="feedback-container">
            <div class="feedback-header">
                <form method="post">
                    <div class="input-box">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="input-box">
                        <div><label>Feedback</label></div>
                        <textarea placeholder="Enter your message" name="feedback" required></textarea>
                    </div>
                    <button type="submit" name="btn" class="submitBtn">Submit</buttom>
                </form>

            </div>
        </div>
    </div>

    <?php
        include("conn.php");
    
        if(isset($_POST['btn'])) {
            $name = $_POST['name']; 
            $message = $_POST['feedback'];

            $user_id = $_SESSION['mySession'];
        
            $sql_insert_payment = "INSERT INTO feedback (name, message, user_id) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql_insert_payment);

            mysqli_stmt_bind_param($stmt, "ssi", $name, $message, $user_id);

            mysqli_stmt_execute($stmt);

            $affected_rows = mysqli_stmt_affected_rows($stmt);
            if($affected_rows == 1) {
                echo '<script>alert("Feedback submitted successful!"); window.location.href = "dashboard.php";</script>';
                exit; 
            } 
            else {
                echo "Error: " . mysqli_error($con);
            }
            mysqli_stmt_close($stmt);
        }
    ?>

</body>
</html>