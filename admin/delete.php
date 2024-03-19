
<?php

if (!isset($_GET['delete'])) {
    header("location:home.php");
}
$id = $_GET['delete'];

include '../conn.php';

$deleteQuery = "DELETE from user_table where user_id='$id'";
$executeQuery = $conn->query($deleteQuery);

if ($executeQuery) {
    echo "<script>alert('record deleted well')</script>";
    header("refresh:0.1;url=home.php");
}
 else
  {
    echo "<script>alert('failed to deleted record')</script>";
    header("refresh:0.1;url=home.php");

}


?>