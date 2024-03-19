<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:index.php");
}

include '../conn.php';
$selectQuery = "SELECT * from user_table";
$executeQuery = $conn->execute_query($selectQuery);

// $i=0
// while ($data = mysqli_fetch_array($executeQuery)) {
//     $name = $data[1];
//     echo "$name";
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <center>
        <h3>users</h3>
        <?php
        if (mysqli_num_rows($executeQuery) < 1) {
            echo "<p>no record exists</p>";
        } else {



        ?>
            <table>
                <tr>
                    <th>index</th>
                    <th>Names</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>date</th>
                    <th>detele</th>
                </tr>
            <?php
            $n = 1;
            while ($data = mysqli_fetch_array($executeQuery)) {
                $name = $data[1];
                $email = $data[2];
                $phone = $data[3];
                $date = $data[5];
                $id = $data[0];

                echo "
                <tr>
                <td>$n</td>
                <td>$name</td>
                 <td>$email</td>
                  <td>$phone</td> 
                  <td>$date</td>
                  <td><a href='javascript:deleteRecord($id)'>delete</a></td>
                </tr>
                
                ";
                $n = $n + 1;
            }
        }
            ?>
            </table>
    </center>


    <script>
        function deleteRecord(id) {
            if (confirm("are you sure you want to delete this record")) {
                window.location.href = 'delete.php?delete='+id;
            }
        }
    </script>

</body>

</html>