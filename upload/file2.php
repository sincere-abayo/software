<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>allowed format ["png","jpg","jpeg","gif","tiff"]
        <br> <input type="submit" name="upload">
    </form>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "tesd_db");
    if (isset($_POST['upload'])) {
        $name = rand(00000, 99999) . $_FILES['image']['name'];
        $path = "upload/";
        $file = $path . basename($name);
        $file_content = $_FILES['image']['tmp_name'];
        $size = $_FILES['image']['size'];
        $info = pathinfo($name);
        $extension = strtolower($info['extension']);
        $allowed_extension = [
            "png", "jpg", "jpeg",
            "gif", "tiff"
        ];
        if (file_exists($file)) {
            echo "file already exist";
        } else {
            if (in_array($extension, $allowed_extension)) {
                if ($size >= 1000000) {
                    echo "file size is larger than 1MB";
                } else {
                    $file_uploaded = move_uploaded_file($file_content, $file);
                    if ($file_uploaded) {

                        $insert = "INSERT INTO image 
                        (image_name) values ('$file')";
                        $execute = $conn->query($insert);
                        if ($execute) {
                            echo "file uploaded to server and inserted well in database";
                        } else {
                            echo "failed to insert into database";
                        }
                    } else {
                        echo "failed to uploaded file on server";
                    }
                }
            } else {
                echo "file not allowed allowed file [png,jpg,jpeg,gif,tiff]";
            }
        }
    }

    $select = "SELECT * from image";
    $executeQuery = $conn->query($select);


    ?>
    <table width="400px">
        <tr>
            <th>no</th>
            <th>image</th>
            <th>date</th>
        </tr>

        <?php
        $n = 1;
        while ($data = mysqli_fetch_array($executeQuery)) {
            $img_name = $data[1];
            $img_date = $data[2];

        ?>
            <tr>
                <td><?php echo $n ?></td>
                <td><img width="200px" height="100px" src="<?php echo $img_name ?>"></td>
                <td><?php echo $img_date ?></td>
            <?php
            $n++;
        }
            ?>
    </table>
</body>

</html>