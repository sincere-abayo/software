<?php
$myfile =fopen("hel.txt","x");
if ($myfile) {
    echo "file created well";
}

else{
    echo "file exist";
}
