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
            <li><a href="#home">Home</a></li>
            <li><a href="appointment.php">Appointment</a></li>
            <li><a href="history.php">Maintenance History</a></li>
            <li><a href="userprofile.php">Profile</a></li>
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
