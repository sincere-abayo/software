<?php

include 'session.php';
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
    <?php

    include 'nav.php';

    ?>
    <div class="main">

        <form method="post">
            <h2>update profile (<?php echo $_SESSION['email'] ?>)</h2>
            <?php
            include 'conn.php';

            $email = $_SESSION['email'];
            $select = mysqli_query($conn, "SELECT * FROM users where u_email ='$email'");
            $userData = mysqli_fetch_array($select);

            if (isset($_POST['update'])) {
                $name = $_POST['names'];
                $phone = $_POST['phone'];
                $update = mysqli_query($conn, "UPDATE users set u_names='$name',u_phone='$phone' where u_email='$email'");
                if ($update) {
                    echo "<p style='color:green'> profile updated well</p>";
                    header("refresh:1; ");
                } else {
                    echo "<p style='color:red'> failed to update profile</p>";
                    // header("refresh:1;url=user.php");
                }
            }


            ?>
            <div><input type="text" name="names" value="<?php echo $userData['u_names'] ?>" required></div>

            <div><input type="phone" name="phone" value="<?php echo $userData['u_phone'] ?>" required></div>
            <div><button type="submit" name="update">update</button> <a href="del.php?email=<?php echo $email; ?>">delete account</a></div>
            <!-- <div><button type="submit" name="update">update</button> <a href="javascript:delleteAccount('<?php //echo $email; ?>')" style="color:red">delete account</a></div> -->

        </form>
    </div>

    <script>
        function delleteAccount(email) {
            if (confirm("are you sure you want to delete account?")) {
                window.location.href = 'del.php?email=' + email;
            }
        }
    </script>
</body>

</html>