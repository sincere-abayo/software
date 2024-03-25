<?php

session_start();
?>
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

    <div class="main">

        <form method="post">
            <h1>Welcome in shop</h1>
            <h2>register to continue</h2>
            <?php
            include 'conn.php';

            if (isset($_POST['register'])) {
                $names = $_POST['names'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];
                $protected = md5($pass1);

                if ($pass1 == $pass2) {
                    $select = mysqli_query($conn, "SELECT * from users where u_email= '$email'");
                    if (mysqli_num_rows($select) > 0) {
                        echo " <p style='color:red'>email already exist</p>";
                    }
                     else {
                        $insert = mysqli_query($conn, "INSERT INTO users (u_names,u_email,u_phone,u_password) values('$names','$email','$phone','$protected')");
                        if ($insert) {
                            $_SESSION['email'] = $email;
                            echo "<p style='color:green'> accoiunt created well,  redirecting...</p>";
                            header("refresh:1;url=user.php");
                        } else {
                            echo " <p style='color:red'>failed to create account</p>";
                        }
                    }
                } else {
                    echo " <p style='color:red'>password not matching</p>";
                }
            }
            ?>
            <div><input type="text" name="names" placeholder="names" required></div>
            <div><input type="email" name="email" placeholder="email" required></div>
            <div><input type="phone" name="phone" placeholder="phone" required></div>
            <div><input type="password" name="pass1" placeholder="password" required minlength="6"></div>
            <div><input type="password" name="pass2" placeholder="confirm password" required minlength="6"></div>
            <div><button type="submit" name="register">register</button></div>
            <label for="account"> do you have account <a href="login.php">login</a></label>

        </form>


    </div>
</body>

</html>