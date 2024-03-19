<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .button {
            width: 40px !important;
            height: 40px !important;
        }

        .main,
        h2 {
            margin-top: 60px !important;
        }
    </style>
</head>

<body>
    <center>

        <h2>Welcome back admin</h2>
        <div class="main">

            <form action="#" method="post">
                <div class="login">
                    <div>Login</div>
                    <div>
                        <input type="text" name="user" placeholder="username">
                    </div>
                    <br>
                    <div>
                        <input type="password" name="password" placeholder="password">
                    </div>
                    <div>
                        <button name="submit" class="button">login</button>
                    </div>

                </div>
            </form>
        </div>

    </center>
</body>

<?php
if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $password = $_POST['password'];
    $encryptedPass = md5($password);
    include '../conn.php';
    $selectQuery = "SELECT * from admin_table where admin_user='$user' AND admin_password = '$encryptedPass'";
    $executeQuery = $conn->query($selectQuery);
    $count = mysqli_num_rows($executeQuery);
    if ($count > 0) {
        $_SESSION['admin']=$user;
        echo "<script>alert ('welcome admin')</script>";
        header("refresh:0.1; url=home.php");
    } else {
        echo "<script>alert ('credintial invalid, try again')</script>";
    }
}

?>

</html>