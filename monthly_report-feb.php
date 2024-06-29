<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="monthly_report-jan.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Report</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Report</h2>
            </div>
        </div>
        <div class="report-container">
                <div class="wrapper-report">
                    <div class="wrapper-report-col">
                        <div class="monthly-report-header">
                            <h3 class="monthly-report-title">Monthy Income Report</h3>
                            <h4 class="monthly-report-subtitle">February</h4>
                        </div>
                        <div class="monthly-report-content-wrapper" >
                            <div class="monthly-report-content">
                                <div class="monthly-report-content-item">Total Monthly Income</div>
                                <?php
                                    include("conn.php");

                                    $sql = "SELECT SUM(amount) AS total_amount FROM payment WHERE MONTH(date) = '02'";
                                    $result = mysqli_query($con, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result); 

                                        if ($row && isset($row['total_amount'])) {
                                            $total_amount = $row['total_amount']; 

                                            echo '<div class="monthly-report-content-item-amount">' . $total_amount . '</div>';
                                        } else {
                                            echo '<div class="monthly-report-content-item-amount">0</div>'; 
                                        }

                                        mysqli_free_result($result); 
                                    } else {
                                        echo '<div class="monthly-report-content-item-amount">Error retrieving data</div>'; // Handle query error
                                    }

                                    mysqli_close($con); 
                                    ?>
                            </div>
                            <div class="monthly-report-content">
                                <div class="monthly-report-content-item">Total Appointment Per Month</div>
                                <?php
                                    include("conn.php");

                                    $sql2 = "SELECT COUNT(*) AS appointment_count FROM appointment WHERE MONTH(timestamp) = '03'";
                                    $result2 = mysqli_query($con,$sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $appointment_count=$row2['appointment_count'];

                                    echo '<div class="monthly-report-content-item-amount">'.$appointment_count.'</div>';
                                ?>                          
                            </div>
                        </div>
                        <div class="monthly-report-footer-wrapper">
                            <div class="monthly-report-content-footer">
                                <h5><div class="monthly-report-content-item">Date Issued:</div></h5>
                                <h5><div class="monthly-report-content-item" id="datetime"></div></h5>
                            </div>
                            <script>
                                
                                var now = new Date();
                                var datetime = now.toLocaleString();

                                
                                document.getElementById("datetime").innerHTML = datetime;
                            </script>
                    </div>
                    <a href="monthly_report.php" style="text-decoration: none; float:right;"><  Back</a>
                </div>
            </div>
            
        </div>
        
    </div>
</body>
</html>