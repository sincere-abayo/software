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
            <h2>login to continue</h2>
            <?php
            include 'conn.php';
            if (isset($_POST['login'])) {
                $email = $_POST['email'];

                $pass = $_POST['pass'];
                $protected = md5($pass);

                $select = mysqli_query($conn, "SELECT * from users where u_email= '$email' AND u_password='$protected' AND u_status=1");
                if (mysqli_num_rows($select) > 0) {
                    $_SESSION['email'] = $email;
                    echo " <p style='color:green'>success, redirecting....</p>";
                    header("refresh:1;url=user.php");

                }
                else{
                    echo " <p style='color:red'>Account not exist or deleted</p>";

                }
            }

            ?>
            <div><input type="email" placeholder="email" name="email"></div>
            <div><input type="password" placeholder="password" name="pass"></div>
            <div><button type="submit" name="login">login</button></div>
            <label for="account"> want to create account <a href="register.php">register</a></label>
        </form>

    </div>
</body>

</html>