<?php
    include("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="payment.css" rel="stylesheet">
    <title>Payment</title>
    <script>
        const paymentMethod = document.querySelectorAll('input[name="payment-method"]');
        const errorMessage = document.querySelector('.error'); // Assuming the error class is applied to an element

        paymentMethod.forEach(radioButton => {
        radioButton.addEventListener('click', checkMethod);
        });

        function checkMethod() {
        const selectedMethod = document.querySelector('input[name="payment-method"]:checked');

        if (!selectedMethod) {
            errorMessage.innerHTML = "You have not chosen a payment method";
            return;
        }

        const selectedValue = selectedMethod.value;
        const paymentFormGroup = document.querySelector('.form-payment');

        paymentFormGroup.style.display = selectedValue === "card" ? "block" : "none";
        }

    </script>
</head>
<body>
    <section class="payment-section">
        <div class="container">
            <div class="payment-wrapper">
                <div class="payment-left">
                    <div class="payment-header">
                        <div class="payment-header-icon"><i class='bx bxs-bolt'></i></div>
                        <div class="payment-header-title"><h2>Order Summary<h2></div>
                    </div>
                    <div class="payment-content">
                        <div class="payment-body">
                            <div class="payment-summary">
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name"><h3>Service Type<h3></div>
                                </div>
                                <div class="payment-summary-item">
                                <?php
                                    include("conn.php");

                                    $user_id = $_SESSION['mySession'];
                                    $id = $_GET['id'];
                                    $sql = "SELECT * FROM  appointment INNER JOIN service on appointment.service_id = service.service_id WHERE user_id = $user_id AND appointment_id = $id";
                                    $result = mysqli_query($con,$sql);

                                    if(mysqli_num_rows($result) > 0 ) {
                                        while ($row=mysqli_fetch_assoc($result)) {
                                            echo '<div class="payment-summary-name">'.$row['service_type'].'</div>';
                                            echo '<div class="payment-summary-item-price" name="amount">RM: '.$row['price'].'</div>';
                                ?> 
                                </div>
                                <div class="payment-summary-item-divider">
                                    <div class="payment-summary-item payment-summary-item-total">
                                        <div class="payment-summary-name">Total</div>
                                        <div class="payment-summary-item-price"><?php echo $row['price'] ?></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <form class="payment-form" method="post">
                        <h1 class="payment-title">Payment Details</h1>
                        <div class="payment-method">
                            <input type="radio" name="payment-method" id="method-1" value="card" required onclick="checkMethod()">
                            <label for="method-1" class="payment-method-item"><i class='bx bxl-visa blue'></i></label>
                            <input type="radio" name="payment-method" id="method-2" value="cash" required onclick="checkMethod()">
                            <label for="method-2" class="payment-method-item"><i class='bx bx-money green'></i></label>
                        </div>
                        <div class="form-payment" style="display: none;">
                            <div class="payment-form-group">
                                <input type="text" class="payment-form-control" placeholder="" id="name">
                                <label for="name" class="payment-form-label payment-form-label-required">Name</label>
                            </div>
                            <div class="payment-form-group">
                                <input type="text" class="payment-form-control" placeholder="" id="card-number">
                                <label for="card-number" class="payment-form-label payment-form-label-required">Card Number</label>
                            </div>
                            <div class="payment-form-group-flex">
                                <div class="payment-form-group">
                                    <input type="date" class="payment-form-control" placeholder="" id="expiry-date">
                                    <label for="expiry-date" class="payment-form-label payment-form-label-required">Expiry Date</label>
                                </div>
                                <div class="payment-form-group" >
                                    <input type="text" class="payment-form-control" placeholder="" id="cvv">
                                    <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit"class="payment-form-submit-button" name="submitBtn"><i class='bx bxs-wallet-alt'></i>Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    }
    ?>

    <?php
        include("conn.php"); 
    
        if(isset($_POST['submitBtn'])) {
           
            $payment_type = $_POST['payment-method']; 
            $total = $_POST['amount'];
            $date = date('Y-m-d'); 

          
            $user_id = $_SESSION['mySession'];
            $id = $_GET['id'];
            $sql = "SELECT price FROM  appointment INNER JOIN service on appointment.service_id = service.service_id WHERE user_id = $user_id AND appointment_id = $id";
            $result = mysqli_query($con,$sql);

            if($result) {
                $row = mysqli_fetch_assoc($result);
                $price = $row['price'];
    
                $sql_insert_payment = "INSERT INTO payment (amount, payment_method, date, user_id, appointment_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $sql_insert_payment);
    
                mysqli_stmt_bind_param($stmt, "sssss", $price, $payment_type, $date, $user_id, $id);
    
                mysqli_stmt_execute($stmt);
    
                $affected_rows = mysqli_stmt_affected_rows($stmt);
                if($affected_rows == 1) {
                    if($payment_type ==  "card") {
                        echo '<script>alert("Payment successful!"); window.location.href = "view_payment.php";</script>';
                    }
                    else if ($payment_type == "cash") {
                        echo '<script>alert("You choose cash payment!"); window.location.href = "view_payment.php";</script>';
                    }
                    exit; 
                } 
                else {
                    echo "Error: " . mysqli_error($con);
                }
    
                mysqli_stmt_close($stmt);
            }
        }
    ?>

</body>
</html>