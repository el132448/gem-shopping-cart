<?php
include_once ('./dbConnect.php');

$op ='none';

if(isset($_GET['op'])){
    $op = $_GET['op'];
}

if($op=='createOrder'){
    createOrder();
}

if($op=='checkLogin'){
    checkLogin($_POST['email'], $_POST['password']);
}

if($op=='logout'){
    logout();
}

function isStaff(){
    return isset($_SESSION['email']);
}

function logout(){
    session_start();
    session_destroy();
    header("Location: ./");
}

function checkLogin($email, $password){
    global $dbConnection;
    $staffQ = mysqli_query($dbConnection, "SELECT * FROM `staff` WHERE `email` = '".$email."'");
    $staff = mysqli_fetch_assoc($staffQ);

    if($email == $staff['email'] && password_verify($password, $staff['password'])){
        session_start();
        $_SESSION['email'] = $_POST['email'];

        header("Location: ./allOrders.php");
    }else{
        header("Location: ./login.php");
    }
    }

function createOrder(){
    //print out the order by local variable(unwanted, now write orders in db by SQL)
    // echo $_POST['gem_id']."<br>";
    // echo $_POST['name']."<br>";
    // echo $_POST['email']."<br>";
    // echo $_POST['quantity']."<br>";
    // echo date('Y-m-d H:i:s')."<br>";

    //save the order by csv(unwanted, now write orders in db by SQL)
    // $myfile = fopen("data.csv", "a") or die("can't open the file");
    // $data = $_POST['gem_id'] .',' .$_POST['name'] .','
    // .$_POST['email'] .',' .$_POST['quantity'] .',' .date('Y-m-d H:i:s') ."\r\n";
    // fwrite($myfile, $data);
    // fclose($myfile);

    //if stock >= quantity, then save the order by SQL
    global $dbConnection;
    $stockQ = mysqli_query($dbConnection, "SELECT * FROM `gem` WHERE `gem_id` = '{$_POST['gem_id']}'");
    $stock = mysqli_fetch_assoc($stockQ);

    if($stock['remaining'] > $_POST['quantity']){
        $sql = "INSERT INTO `php_gem`.`order` (
            `client_name`, 
            `client_email`,
            `quantity`, 
            `order_time`, 
            `gem_id`
            ) VALUES (
            '{$_POST['name']}', 
            '{$_POST['email']}',
            {$_POST['quantity']}, 
            '".date('Y-m-d H:i:s')."',
            {$_POST['gem_id']})";
        
        //write into MySQL
        if (mysqli_query($dbConnection, $sql)){

            //update remaining stocks
            $sql = "UPDATE `php_gem`.`gem` SET `remaining`= `remaining` - {$_POST['quantity']} WHERE `gem_id`= '{$_POST['gem_id']}'";
            mysqli_query($dbConnection, $sql);

            //jump page
            header("Location: ./order-completed.php");
        }else{
            //jump to order failed page
            header("Location: ./orderFailed.php");
        }
    }else{
        //jump to out of stock page
        header("Location: ./outOfStock.php");
    }
    
}

?>