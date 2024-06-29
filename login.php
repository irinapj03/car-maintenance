<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="login.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>
<body>
    <?php
        include("conn.php");
        session_start();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $useremail = $_POST['email'];
            $userpassword = $_POST['password'];


            $sql_users = "SELECT * FROM users WHERE user_email = ? AND user_password = ?";
            $stmt_users = mysqli_prepare($con, $sql_users);
            mysqli_stmt_bind_param($stmt_users, 'ss', $useremail, $userpassword);
            mysqli_stmt_execute($stmt_users);
            $result_users = mysqli_stmt_get_result($stmt_users);
            $row_users = mysqli_fetch_array($result_users);
            
            if ($row_users) {
                $_SESSION['mySession'] = $row_users['id']; 
                header("location:dashboard.php");
                exit();
            } else {
                $sql_admin = "SELECT * FROM admin WHERE user_email = ? AND user_password = ?";
                $stmt_admin = mysqli_prepare($con, $sql_admin);
                mysqli_stmt_bind_param($stmt_admin, 'ss', $useremail, $userpassword);
                mysqli_stmt_execute($stmt_admin);
                $result_admin = mysqli_stmt_get_result($stmt_admin);
                $row_admin = mysqli_fetch_array($result_admin);
                
                if ($row_admin) {
                    $_SESSION['mySession'] = $row_admin['id'];
                    header("location:admin_dashboard.php");
                    exit();
                } else {
                    echo '<script>alert("Your Email or Password is invalid. Please try again");</script>';
                }
            }
            
            mysqli_stmt_close($stmt_users);
            mysqli_stmt_close($stmt_admin);
            mysqli_close($con);
        }
    ?>
    <div class="wrapper">
        <form method="post" action="">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Enter email address" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Enter password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
