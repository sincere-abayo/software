<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file"> (allowed format )
        <input type="submit" name="submit">
        <img src="" alt="">
    </form>

    <?php
    if (isset($_POST['submit'])) {

        //getting file name
        // //    echo  $_FILES['file']['name'];
        //getting file size
        //    echo  $_FILES['file']['size'];

        // getting file content
        //    echo  $_FILES['file']['tmp_name'];
        $dir = "images/";
        $file_name = $_FILES['file']['name'];
        $file_path = $dir . basename($file_name);

        $info = pathinfo($file_name);
        $extension = strtolower($info['extension']);
        // $extension = $info['extension'];

        $allowed_extension = ["jpeg", "jpg", "png", "gif", "tiff", "imap"];
        $file_size = $_FILES['file']['size'];

        if (in_array($extension, $allowed_extension)) {

            if ($file_size < 1000000) {
                if (file_exists($file_path)) {
                    echo "file already exist";
                } else {
                    $done = move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
                    if ($done) {
                        echo "file uploaded well";
                    } else {
                        echo "failed to upload file";
                    }

                    //    echo "file not exist";
                }
                // echo "file size ok";
            } else {
                echo "file size is larger than 1MB";
            }
        } else {


            echo " file not image ";
        }

        // echo $extension;
    }
    ?>


   
</body>

</html>