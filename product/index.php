<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <div class="nav">
            <a href="login.php">login</a>
            <a href="register.php">register</a>
            <a style="float: left;" href="index.php">home</a>
        </div>
    </nav>


    <table>
        <?php
        include 'conn.php';
        $selectProduct = mysqli_query($conn, "SELECT * from users join product on (users.u_id = product.u_id)");

        ?>

        <div class="table">

            <?php
            $counter = 0;
            while ($productData = mysqli_fetch_array($selectProduct)) {
                if ($counter >= 4) {
                    echo '</div> <div class="table">';
                    $counter = 0;
                }
                $counter++;
            ?>

                <div class="row ">
                    <p class="center">name: <?php echo $productData['p_name'] ?>
                        qty: <?php echo $productData['p_quantity'] ?></p>
                    <img src="<?php echo $productData['p_image'] ?>" alt="">
                    <p class="center"><?php echo $productData['p_desc'] ?></p>
                    <p class="center"><?php echo $productData['p_date'] ?></p>
                    <p class="center">by: <?php echo $productData['u_names'] ?></p>
                </div>

            <?php
            }
            ?>
        </div>


</body>

</html>