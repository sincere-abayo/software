<?php
session_start();
if (!isset($_SESSION['email'])) {
   
    echo "<script>window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>

        <header>


            <div class="nav">

                <ul>
                    <li style="float:left"><a class="active" href="home.php">Home</a></li>
                    <li><a href="profile.php">profile</a></li>
                    <li><a href="logout.php">log out</a></li>

                </ul>
            </div>


        </header>
    </section>

    <h1>
        welcome <?php echo $_SESSION['email']; ?>
    </h1>
</body>

</html>