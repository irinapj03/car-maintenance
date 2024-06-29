<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="services.css" rel="stylesheet">
    <title>Services</title>
</head>
<body>
    <div>
        <div class="image">
            <div class="image-overlay">
                <?php
                    include("navbar1.php");
                ?>
                <h1 class="slide-left" style="padding: 1.5rem; max-width: 1300px" id="service-header">Our Services</h1>
                <p class="slide-left" style="padding: 1.5rem; margin-left: 20%; max-width: 800px">We provide top-notch car maintenance services, including regular inspections, oil changes, brake repairs, tire rotations, and engine diagnostics. Our skilled technicians ensure your vehicle runs smoothly and safely, keeping you on the road with peace of mind.</p>
            </div>
        </div>
    </div>
    <section class="services">
        <?php
            include ("conn.php");
            $sql = "SELECT * FROM service";
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0 ) {
                while ($row=mysqli_fetch_assoc($result)) {
        
                    echo '<div class="row">';
                        echo '<div class="services-col">';
                            echo '<h3>'.$row['service_type'].'</h3>';
                            echo '<p class="description">'.$row['service_description'].'</p>';
                            echo '<h5 class="description">Price: '.$row['price'].'</h5>';
                    echo '</div>';
                }
            }
        ?>
    </section>
    
</body>
</html>