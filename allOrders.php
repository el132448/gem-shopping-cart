<?php 
include_once('header.php');
include_once('functions.php');
include_once ('dbConnect.php');

//check staff or not
if(!isStaff()){
    header("Location: ./login.php");
}

?>

<h1>All Orders</h1>
<h2>Your login email is : <?php echo $_SESSION['email'];?></h2>

<?php

//get order info from csv(unwanted)
// $orderData = file_get_contents('data.csv');
// $orders = str_getcsv($orderData, "\r\n");



//show all the order of csv
// foreach($orders as $order){
//     $singleOrder = explode(",", $order); //explode a string to array by ,

//get order info from MySQL
$orderQ = mysqli_query($dbConnection, "SELECT * FROM `order`");

    while($order = mysqli_fetch_assoc($orderQ)){
        $gemQ = mysqli_query($dbConnection, 'SELECT * FROM `gem` WHERE `gem_id` = '.$order['gem_id']);
        $gem = mysqli_fetch_assoc($gemQ);

        echo '<div class="order"> <p>
        Order id : '.$order['order_id'].'<br>
        Client name : '.$order['client_name'].'<br>
        Client email : ' .$order['client_email'].'<br>
        Product name : ' .$gem['name'] .'<br>
        Quantity : ' .$order['quantity'].'<br>
        Order time : ' .$order['order_time'].'</p></div>';
    }

    // echo '<div class="order"><p>';
    // echo 'Customer name : ' .$singleOrder[1] .'<br>';
    // echo 'Customer email : ' .$singleOrder[2] .'<br>';
    // echo 'ordered goods : '.$gems[$singleOrder[0]-1]['name'].' x '
    // .$singleOrder[3] .'<br/>';
    // echo 'Ordered time : ' .$singleOrder[4] .'<br/>';
    // echo '</p></div>';

?>

<?php include_once('footer.php'); ?>