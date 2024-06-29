<?php
    include 'conn.php';
    include ("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="userprofile.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Profile</title>
    <script>
        function checkPassword(form) {
            var password = form.password.value;
            var confirm_pass = form.confpassword.value;

            if (password != confirm_pass) {
                alert("Passwords do not match!")
                return false;
            }
               
        }
    </script>
</head>
<body>
    <?php
        include ("dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Edit Profile</h2>
            </div>
        </div>
        <div class="profile-container">
            <div class="profile-header">
                <div class="form-col">
                <?php
                    $user_id = $_SESSION['mySession'];

                    $result = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id");

                    if ($result === false) {
                        echo "Error: " . mysqli_error($con);
                    } else {
                        $row = mysqli_fetch_assoc($result);
                    }

                    try {
                        if ($_SERVER['REQUEST_METHOD'] == "POST") {
                            $name = $_POST['name'];
                            $ic_num = $_POST['ic_num'];
                            $email = $_POST['user_email'];
                            $phone = $_POST['phone_number'];
                            $gender = $_POST['gender'];
                            $age = $_POST['age'];
                            $password = $_POST['password'];
                            $id = $_POST['id'];


                            $stmt = mysqli_prepare($con, "UPDATE users SET name = ?, ic_number = ?, user_email = ?, user_phone = ?, gender = ?, user_age = ?, user_password = ? WHERE id = ?");

                            if ($stmt === false) {
                                throw new Exception("Error in preparing the statement: " . mysqli_error($con));
                            }

                            mysqli_stmt_bind_param($stmt, "sssssssi", $name, $ic_num, $email, $phone, $gender, $age,  $password, $user_id);

                            $result = mysqli_stmt_execute($stmt);

                            if ($result === false) {
                                throw new Exception("Error in executing the statement: " . mysqli_error($con));
                            } else {
                                mysqli_stmt_close($stmt);
                                header("Location: dashboard.php");
                                exit;
                            }
                        }
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
                    <form method="post" enctype="multipart/form-data" onsubmit="return checkPassword(this);">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="input-box">
                                <label>Name:</label>
                                <div class="enter"><input type="text" placeholder="Name" name="name" value="<?php echo $row['name']?>" required></div>
                            </div>
                            <div class="input-box">
                                <label>IC Number:</label>
                                <div class="enter"><input type="text" placeholder="IC Number" name="ic_num" value="<?php echo $row['ic_number']?>" required></div>
                            </div>
                            <div class="input-box">
                                <label>Email:</label>
                                <div class="enter"><input type="text" placeholder="Email" name="user_email" value="<?php echo $row['user_email']?>" required></div>
                            </div>
                            <div class="input-box">
                                <label>Phone Number:</label>
                                <div class="enter"><input type="text" placeholder="Phone Number" name="phone_number" value="<?php echo $row['user_phone']?>" required></div>
                            </div>
                            <div class="input-box">
                                <label>Age:</label>
                                <div class="enter"><input type="number" name="age" placeholder="Age" value="<?php echo $row['user_age']?>" required></div>
                            </div>
                            <div class="input-box">
                                <label>Gender:</label>
                                <div class="enter"><select name="gender">
                                    <option value="Male"<?php if ($row['gender'] == 'Male') echo ' selected'; ?>>Male</option>
                                    <option value="Female"<?php if ($row['gender'] == 'Female') echo ' selected'; ?>>Female</option>
                                    <option value="Prefer not to say"<?php if ($row['gender'] == 'Prefer not to say') echo ' selected'; ?>>Prefer not to say</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-box">
                                <label>Change Password:</label>
                                <div class="enter"><input type="password" placeholder="Password"name="password" value="<?php echo $row['user_password']?>"  required></label>
                            </div>
                            <div class="input-box">
                                <label>Confirm Password:</label>
                                <div class="enter"><input type="password" placeholder="Confirm Password" name="confpassword"  required></div>
                            </div>
                            <button name="submitBtn" type="submit" class="btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>