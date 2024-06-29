<?php
    include("session.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="cash_payment_request.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cash Payment</title>
</head>
<body>
    <?php
        include ("admin_dashboard_nav.php")
    ?>
    <div class="box">
        <div class="box-header">
            <div class="col">
                <h2>Confirm Cash Payment</h2>
            </div>
        </div>
        <div class="payment-list-container">
            <div class="payment-header">
                <table>
                    <tr>
                        <th>Payment ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Confirm Payment</th>
                    </tr>
                    <?php
                    include("conn.php");

                    $sql = "SELECT * FROM payment WHERE payment_method = 'cash' AND status NOT IN ('Confirm')";
                    $result = mysqli_query($con,$sql);

                    if(mysqli_num_rows($result) > 0 ) {
                        while ($row=mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'.$row['payment_id'].'</td>';
                                echo '<td>'.$row['user_id'].'</h5></td>';
                                echo '<td>'.$row['amount'].'</td>';
                                echo '<td>'.$row['payment_method'].'</td>';
                                echo '<td>'.$row['date'].'</td>';
                                echo '<td>';
                                    if ($row['payment_method'] =='cash') {
                                        echo "<form action='confirm_cash_payment.php' method='POST'>";
                                        echo "<input type='hidden' name='payment_id' value='" . $row['payment_id'] . "'>";
                                        echo "<button type='submit' name='confirm' value='Confirm' class='btn'>Confirm</button>";
                                        echo "</form>";
                                    } else {
                                        echo '';
                                    }
                                echo '</td>';       
                            echo '</tr>';
                        
                        }
                    }

                    else {
                        echo '<td colspan = "8"; style="text-align: center;">No payments!</td>';
                    }

                    ?>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>