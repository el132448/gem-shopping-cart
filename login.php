<?php include_once('./header.php'); ?>

<form action="./functions.php?op=checkLogin" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" require><br>

    <label for="email">Password:</label>
    <input type="password" id="password" name="password" min="1" max="5">

     <br>
     <input type="submit" value="Login">
</form>   

<?php include_once('./footer.php'); ?>