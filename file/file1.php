<?php
$file_name = fopen("hell.txt", "r") or die ("fail not exist");

//getting file size
$size = filesize("hello.txt");
// echo $size;

//reading all file 
echo fread($file_name,$size);

// echo fgets($file_name);
feof($file_name);
$a = 1;
//getting file by line 
while (!feof($file_name)) {
    echo  fgets($file_name) . "<br>";
    $a++;
}


//getting file by character
while (!feof($file_name)) {
    echo  fgetc($file_name) . " ";
    $a++;
}
