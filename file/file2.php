<?php

$myfile= fopen("class.txt","a");

if (fwrite($myfile, "new data")) 
{
    echo "done";
   $file_name=fopen("class.txt","r");

   echo fread($file_name,filesize("class.txt"));
}
else 
{
    echo "failed to write on file";
}


fclose($myfile);

