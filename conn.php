<?php

$conn= mysqli_connect("localhost","root","", "tesd_db");

if (!$conn) {
    echo " failed to connect";
}