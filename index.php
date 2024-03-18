<?php 

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>index</title>

    <style>
        #login-message,
        #register-message {

            color: green;
            display: none;
        }
    </style>
</head>

<body>

    <section>

        <header>


            <div class="nav">

                <ul>
                    <li style="float:left"><a class="active" href="#home">Home</a></li>
                    <li><a href="#login" id="login-btn">login</a></li>
                    <li><a href="#register" id="register-btn">register</a></li>

                </ul>
            </div>


        </header>
    </section>
    <section>
        <div class="main">

            <div id="login">
                <p id="login-message">message</p>
                <form action="#" method="post">
                    <h1>login form</h1>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" name="email" placeholder="enter username" required>

                    </div>
                    <div>
                        <label for="username">password</label>
                        <input type="password" name="pass" placeholder="enter password" required>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="button" name="login">login</button>

                    </div>
                </form>
            </div>
            <div id="register">
                <p id="register-message">registeration form submitted</p>
                <form action="#" method="post">
                    <h1>register form</h1>
                    <div class="form-group">
                        <label for="username">names</label>
                        <input type="text" name="names" placeholder="enter names" required>

                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" name="email" placeholder="enter email" required>

                    </div>
                    <div class="form-group">
                        <label for="phone">phone</label>
                        <input type="text" name="phone" placeholder="enter phone number" required>

                    </div>

                    <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" name="pass1" placeholder="enter password" required minlength="8" maxlength="12">

                    </div>

                    <div>
                        <label for="password">confirm-password</label>
                        <input type="password" name="pass2" placeholder="re-enter password" required>

                    </div>
                    <div class="form-group">
                        <button class="button" name="register" type="submit">register</button>
                    </div>


                </form>
            </div>
        </div>

        <?php

        include 'conn.php';
        if (isset($_POST['register'])) {

            $name = $_POST['names'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            $encryptedPass = md5($pass1);

            if ($pass1 != $pass2) {
                echo "<script>alert('password not matching, try again')</script>";

                return;
            }



            $query = "SELECT * from user_table where user_email ='$email'";

            $bindQuery = $conn->query($query);

            $count = mysqli_num_rows($bindQuery);


            if ($count > 0) {
                echo "<script>alert('email already exist')</script>";
            } else {

                $insert = "INSERT into user_table (user_names,user_email,user_phone,user_password)
                 values('$name','$email','$phone','$encryptedPass')";
                $bindInsert = $conn->query($insert);

                if ($bindInsert === TRUE) {
 
                $_SESSION['userEmail']= $email;

                    echo "<script>alert('account created well');</script>";
                    //php header location 
                    header("refresh:1;url=home.php");

                    // header("location:home.php");

                } else {
                    echo "<script>alert('failed to  create account')</script>";
                }
            }




            // echo  "<script> alert('registration form submitted')</script>";
        }

        if (isset($_POST['login'])) {

            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $encryptedPass = md5($pass);

            $selectQuery = "SELECT * from user_table where  user_email = '$email'   AND user_password = '$encryptedPass'";

            $executeQuery = $conn->query($selectQuery);
            $count = mysqli_num_rows($executeQuery);

            if ($count) {

                $_SESSION['email'] = $email;
                echo "<script> alert('login successfuly')</script>";
                header("refresh:1;url=home.php");
            } else {
                echo "<script> alert('$email $encryptedPass')</script>";
            }
        }

        ?>

    </section>
    <!-- <script src="script.js"></script> -->
    <script>
        document.getElementById('register-btn').addEventListener('click', function() {
            // alert('register');
            const loginBlock = document.getElementById('login');
            const registerBlock = document.getElementById('register');

            loginBlock.style.display = "none";
            registerBlock.style.display = "block";

        });
        document.getElementById('login-btn').addEventListener('click', function() {
            const loginBlock = document.getElementById('login');
            const registerBlock = document.getElementById('register');

            loginBlock.style.display = "block";
            registerBlock.style.display = "none";

        });

        function logMessage() {
            document.getElementById("login-message").style.display = "block";
        }

        function regMessage() {
            document.getElementById("register-message").style.display = "block";
        }
    </script>
</body>

</html>