<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="monthly_report.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Choose Month</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Month</h2>
            </div>
        </div>
        <div class="month-container">
            <div class="month-header">
                <div class="month-col">
                    <h3><a href="monthly_report-jan.php">January</a></h3>               
                </div>
                <div class="month-col">
                    <h3><a href="monthly_report-feb.php">February</a></h3>
                </div>
                <div class="month-col">
                    <h3><a href="monthly_report-march.php.">March</a></h3>
                </div>
                <div class="month-col">
                    <h3><a href="monthly_report-april.php">April</a></h3>
                </div>
                <div class="month-col">
                    <h3><a href="monthly_report-may.php">May</a></h3>
                </div>
                <div class="month-col">
                    <h3><a href="monthly_report-june.php">June</a></h3>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>