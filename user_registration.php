<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="user_registration.css" rel="stylesheet">
    <title>User Registration</title>

    <script>
        function checkPassword(form) {
            var password = form.password.value;
            var confirm_pass = form.confpassword.value;

            if (password !== confirm_pass) {
                alert("Passwords do not match!");
                return false;
            }

            return true;
        }

        function checkPositive(form) {
            var age = form.age.value;

            if (age < 0) {
                alert("Please enter a correct age!");
                return false;
            }

            return true;
        }
    </script>

</head>
<body>
    <div class="wrapper-col">
        <form method="post" enctype="multipart/form-data" onsubmit="return checkPassword(this) && checkPositive(this);">
            <h2>User Registration</h2>
                <div class="input-box">
                    <input type="text" placeholder="Username" name="user_name" required>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Name" name="name" required>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="IC Number" name="ic_num" pattern="[0-9]{6}-[0-9]{2}-[0-9]{4}" required>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Email" name="user_email"  required>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Phone Number" name="phone_number" pattern="[0-9]{3}-[0-9]{7}" required>
                </div>
                <div class="input-box">
                    <select name="gender">
                        <option value="" disable selected>Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Prefer not to say</option>
                    </select>
                <div class="input-box">
                    <input type="number" name="age" placeholder="Age" required>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password"name="password"  required>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Confirm Password" name="confpassword"  required>
                </div>

                <button name="submitBtn" type="submit" class="btn">Submit</button>
                <button type="reset" class="btn">Reset</button>
        </form>
    </div>

    <?php
        include("conn.php");

        if(isset($_POST['submitBtn'])) {
            $user_name = $_POST['user_name'];
            $name = $_POST['name'];
            $ic = $_POST['ic_num'];
            $user_email= $_POST['user_email'];
            $user_phone= $_POST['phone_number'];
            $user_gender= $_POST['gender'];
            $user_age= $_POST['age'];
            $user_password= $_POST['password'];
            $conf_password = $_POST['confpassword'];

        

            $sql_check = "SELECT * FROM users WHERE user_name = ? OR user_email = ? ";
            $stmt_check = mysqli_prepare($con, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "ss", $user_name, $user_email);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);
            $num_rows = mysqli_stmt_num_rows($stmt_check);
    
            if ($num_rows > 0) {
                echo '<script>alert("Username OR email already exists!");</script>';
            }
            else { 
                $sql_check2 = "SELECT * FROM users WHERE ic_number = ?";
                $stmt_check2 = mysqli_prepare($con, $sql_check2);
                mysqli_stmt_bind_param($stmt_check2, "s", $ic);
                mysqli_stmt_execute($stmt_check2);
                mysqli_stmt_store_result($stmt_check2);
                $num_rows2 = mysqli_stmt_num_rows($stmt_check2);

                if ($num_rows2 > 0) {
                    echo '<script>alert("IC Number already exists!");</script>';
                }

                else { 
                    $sql_check3 = "SELECT * FROM users WHERE user_phone = ?";
                    $stmt_check3 = mysqli_prepare($con, $sql_check3);
                    mysqli_stmt_bind_param($stmt_check3, "s", $user_phone);
                    mysqli_stmt_execute($stmt_check3);
                    mysqli_stmt_store_result($stmt_check3);
                    $num_rows3 = mysqli_stmt_num_rows($stmt_check3);
    
                    if ($num_rows3 > 0) {
                        echo '<script>alert("Phone number already exist!");</script>';
                    }

                    else {
                        $sql_check_admin = "SELECT * FROM admin WHERE user_name = ? OR user_email = ? ";
                        $stmt_check_admin = mysqli_prepare($con, $sql_check_admin);
                        mysqli_stmt_bind_param($stmt_check_admin, "ss", $user_name, $user_email);
                        mysqli_stmt_execute($stmt_check_admin);
                        mysqli_stmt_store_result($stmt_check_admin);
                        $num_rows_admin = mysqli_stmt_num_rows($stmt_check_admin);
                
                        if ($num_rows_admin > 0) {
                            echo '<script>alert("Username OR email already exists!");</script>';
                        }
                        else { 
                            $sql_check2_admin = "SELECT * FROM admin WHERE ic_number = ?";
                            $stmt_check2_admin = mysqli_prepare($con, $sql_check2_admin);
                            mysqli_stmt_bind_param($stmt_check2_admin, "s", $ic);
                            mysqli_stmt_execute($stmt_check2_admin);
                            mysqli_stmt_store_result($stmt_check2_admin);
                            $num_rows2_admin = mysqli_stmt_num_rows($stmt_check2_admin);
            
                            if ($num_rows2_admin > 0) {
                                echo '<script>alert("IC Number already exists!");</script>';
                            }
            
                            else { 
                                $sql_check3_admin = "SELECT * FROM admin WHERE user_phone = ?";
                                $stmt_check3_admin = mysqli_prepare($con, $sql_check3_admin);
                                mysqli_stmt_bind_param($stmt_check3_admin, "s", $user_phone);
                                mysqli_stmt_execute($stmt_check3_admin);
                                mysqli_stmt_store_result($stmt_check3_admin);
                                $num_rows3 = mysqli_stmt_num_rows($stmt_check3_admin);
                
                                if ($num_rows3 > 0) {
                                    echo '<script>alert("Phone number already exist!");</script>';
                                }

                                else {
                                    $sql = "INSERT INTO users (user_name, name, ic_number, user_email, user_phone, gender, user_age, user_password) VALUES ('$user_name', '$name', '$ic', '$user_email','$user_phone', '$user_gender', '$user_age', '$user_password')";
                            
                                    $stmt = mysqli_prepare($con,$sql);
                                    mysqli_stmt_execute($stmt);
                                    $check = mysqli_stmt_affected_rows($stmt);
                                    
                                    if($check == 1) {
                                        echo '<script>alert("Successfully registered!");window.location.href="user_list.php";</script>'; 
                                    }
            
                                }
                            } 
                        }
                    }
                }
            }
        }
    ?>

</body>
</html>