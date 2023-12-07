<?php
$dbConnection = mysqli_connect("localhost","root","","php_gem");
// For hosting on 000webhost
// $dbConnection = mysqli_connect("localhost","id21638519_root","aA1997030227!","id21638519_php_gem");

//check the connection success of not
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " .mysqli_connect_error();
    exit();
}

// echo "connection success";

//change to UTF-8 for showing Chinese
mysqli_set_charset($dbConnection, "utf8");

