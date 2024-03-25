<?php
if (!isset($_GET['email'])) {
    header('location:profile.php');
}
include 'conn.php';
$email= $_GET['email'];

$updateStatus=mysqli_query($conn,"UPDATE users set u_status=0 where u_email='$email'");

if ($updateStatus) {
    echo "<script>alert('account deleted well')</script>";
    header("refresh:0.5;url=logout.php");
} 
else {
    echo "<script>alert('failed to delete accouunt')</script>";
    header("refresh:0.5;url=profile.php");
   
}


