<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="navbar1.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <nav class="scrolled">
        <div class="logo">
            <img src="logo1.png">
            <span>Repair 4U<span>
        </div>
        <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="#about-container">About</a></li>
            <li><a href="services.php">Services</a></li>
            <?php
                session_start();

                if(isset($_SESSION['mySession'])) {
                    $user_id = $_SESSION['mySession'];
                    include("conn.php");
                    $sql = "SELECT user_name FROM users WHERE id = '$user_id'";
                    $result = mysqli_query($con, $sql);
                
                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                        echo '<li><a href="dashboard.php">'.$row['user_name'].'</a></li>';
                        }
                    }
                }
                else {
                    echo '<li><a href="login.php">Register/Login</a></li>';
                }
                
            ?>
        </ul>
    </nav>
</body>
<script>
    const header = document.querySelector('nav');

    window.addEventListener('scroll', () => {
        if(window.scrollY > 0) {
            header.classList.add('scrolled');
        }
        else {
            header.classList.remove('scrolled');
        }
    });

</script>
</html>
