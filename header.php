<?php
session_start();
include_once 'stock.php';
include_once 'dbConnect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gem Order</title>
    <link rel="stylesheet" href="./css/css4.css">
</head>
<body>
    <nav>
        <ul class="clientMenu">
            <li><a href="./">Homepage</a></li>
            <li><a href="./about.php">About</a></li>
        </ul>
        <ul class="staffMenu">
            <?php
            if($_SESSION){
                echo '<li><a href="./allOrders.php">All Orders</a></li>
                <li><a href="./functions.php?op=logout">Logout</a></li>';
            }else{
                echo '<li><a href="./login.php">Staff login</a></li>';
            }
            ?>
        </ul>
    </nav>