<?php include_once('header.php'); ?>

<h1>Order Gem</h1>
<h2><?php echo date('F');?> Discount</h2>

<div class="flex-grid">
    <?php

    //showing goods at Homepage
    $gemQ = mysqli_query($dbConnection, "SELECT * FROM `gem`");

    while($gem = mysqli_fetch_assoc($gemQ)){
        echo '<div class="col"> 
        <img src="./images/'.$gem['image'].'"/>
        <p>
        Name : '.$gem['name'].'<br>
        Price : $' .$gem['price'].'<br>';
        
        //out of stock button
        if($gem['remaining'] > 0){
            echo '<a href="./order.php?gem_id='.$gem['gem_id'].'" class="buyBtn">Order Now</a><br></div>';
        }else{
            echo '<a class="outOfStockBtn">Out of stock</a><br></div>';
        }
    }

    //show all product locally using stock.php
    // foreach ($gems as $key => $gem){
    //     echo '<div class="col"> <img src="/images/'.$gem['image'].'"/>
    //     <p>
    //     Name : '.$gem['name'].'<br>
    //     Price : $' .$gem['price'].'<br>
    //     <a href="/order.php?gem_id='.$gem['gem_id'].'" class="buyBtn">Order '.$gem['name'].'</a><br>
    //     </div>';
    // }

        ?>
</div>

<?php include_once('footer.php'); ?>