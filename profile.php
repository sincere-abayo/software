<?php
session_start();
if (!isset($_SESSION['email'])) 
{
    header("location:index.php");
}

include 'conn.php';

$email = $_SESSION['email'];
$selectQuery = "SELECT * from user_table where user_email='$email'";
$executeQuery = $conn->query($selectQuery);
$data = mysqli_fetch_array($executeQuery);
// $data=mysqli_fetch_assoc($executeQuery);
// print_r($data);
$names = $data[1];
$email = $data[2];
$phone = $data[3];
$date = $data[5];

if (isset($_POST['update'])) {

    $nm = $_POST['names'];
    //    $em=$_POST['email'];
    $ph = $_POST['phone'];


    $updateQuery = "UPDATE user_table set user_names='$nm', user_phone='$ph' where user_email='$email'";

    $executeQuery = $conn->query($updateQuery);

    if ($executeQuery) {
        echo "<script>alert ('update success')</script>";
        header("refresh:0.1; ");
    } else {
        echo "<script>alert ('update fail')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            margin-top: 20px;
            width: 700px;

            justify-content: center;
            text-align: center;
        }

        table,
        tr,
        td {
            border: none;
        }
    </style>
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
    <center>

        <table>
            <tr>
                <th>Names</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
            </tr>
            <tr>
                <td><?php echo $names ?></td>
                <td><?php echo $email ?> </td>
                <td><?php echo $phone ?></td>
                <td><?php echo $date ?></td>
            </tr>
        </table>

        <form action="#" method="post">
            <div class="main">
                <div class="form-group">
                    <input type="text" name="names" value="<?php echo $names ?>" required>
                </div>
                <!-- <div class="form-group">
                    <input type="email" name="email" value="<?php echo $email ?>" readonly>
                </div> -->
                <div class="form-group">
                    <input type="text" name="phone" value="<?php echo $phone ?>" required>
                </div>
                <div>
                    <button name="update" class="button">update</button>

                </div>
            </div>
        </form>
    </center>

</body>

</html>