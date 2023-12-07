<?php include_once('header.php'); ?>

<form action="./functions.php?op=createOrder" method="post">
    <label for="gem_name">Order form</label>
    
    <!-- pre-fill the gem name since it is known -->
    <input 
        type="hidden" id="gem_id" name="gem_id" 
        value="<?php echo $_GET['gem_id'];?>">

    <!-- Query String查詢字串: value after .php? -->
    <!-- $_GET: super global -->
    <h3><?php echo $gems[$_GET['gem_id']-1]['name'];?></h3>

    <label for="name">Your name:</label>
    <input type="text" id="name" name="name" required><br/>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br/>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" max="5" value="1"><br/>

    <!-- show stock -->
    <label><?php 
    global $dbConnection;
    $stockQ = mysqli_query($dbConnection, "SELECT * FROM `gem` WHERE `gem_id` = '{$_GET['gem_id']}'");
    $stock = mysqli_fetch_assoc($stockQ);
    echo 'Stock = '.$stock['remaining'];
    ?></label>

    <br>
    <!-- Place the order button -->
    <input class="buyBtn" type="submit" value="Place the order">
</form>

<?php include_once('footer.php'); ?>