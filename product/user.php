<?php

include 'session.php';
include 'conn.php';
$email = $_SESSION['email'];
$select = mysqli_query($conn, "SELECT * FROM users where u_email='$email'");
$userData = mysqli_fetch_array($select);
$userId = $userData['u_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'nav.php';
    ?>


    <div class="main">
        <div class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <h1 class="center">Upload new product</h1>
                <h3 class="center">fill all field</h3>
                <?php

                if (isset($_POST['upload'])) {
                    $name = $_POST['name'];
                    $qty = $_POST['qty'];
                    $desc = $_POST['desc'];
                    $path = "images/";
                    $file_name = rand(00000, 99999) . basename($_FILES['image']['name']);
                    $file = $path . $file_name;
                    $info = pathinfo($_FILES['image']['name']);
                    $extension = strtolower($info['extension']);
                    $allowed_extension = ['png', 'jpg', 'jpeg', 'gif'];
                    $file_size = $_FILES['image']['size'];
                    if (file_exists($file)) {
                        echo "<p style='color:red'> file exists </p>";
                    } else {
                        if (in_array($extension, $allowed_extension)) {

                            if ($file_size <= 10000000) {
                                $uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $file);
                                if ($uploaded) {
                                    $insert = mysqli_query($conn, "INSERT INTO product values('','$userId','$name','$qty','$desc','$file',now())");
                                    if ($insert) {
                                        echo "<p style='color:green'> product added well </p>";
                                        header("refresh:1; ");
                                    } else {
                                        echo "<p style='color:red'> failed to add new product</p>";
                                    }
                                } else {
                                    echo "<p style='color:red'> failed to upload file on server </p>";
                                }
                            } else {
                                echo "<p style='color:red'> file size is too large </p>";
                            }
                        } else {
                            echo "<p style='color:red'> file not allowed </p>";
                        }
                    }
                }


                $selectProduct = mysqli_query($conn, "SELECT * from users join product on (users.u_id = product.u_id) where users.u_id='$userId'");

                ?>
                <div><input type="text" name="name" placeholder="name of product" required>
                    <input type="number" name="qty" placeholder="quantity of product" required>
                </div>
                <div><textarea name="desc" id="" cols="20" rows="1" required>describe product</textarea>
                    <input type="file" name="image" required>
                </div>
                <br>
                <div class="center"><button type="submit" name="upload">add product</button></div>

            </form>
        </div>
    </div>

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
                <img src="<?php echo $productData['p_image'] ?>" alt="">
                <p class="center"><?php echo $productData['p_name'] ?>
                    <?php echo $productData['p_quantity'] ?></p>
                <p class="center"><?php echo $productData['p_desc'] ?></p>
                <p class="center"><?php echo $productData['p_date'] ?></p>
            </div>

        <?php
        }
        ?>
    </div>



</body>

</html>