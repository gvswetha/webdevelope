<?php

include_once 'user.class.php';
//include_once 'load.php';


$signup = false;

if(isset($_POST['username']) and isset($_POST['email']) and isset($_POST ['password']) and isset($_POST ['reenterpassword'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST ['password'];
    $reenterpassword = $_POST ['reenterpassword'];
    $result= user::signup($user, $email, $password, $reenterpassword);
    $signup = true;
}
?>

<div class="from">
    <?php
    if($signup){
        if($result){
        ?>
            <h1>Login Success</h1>
            <p> Now you can login <a href="login.html">login</a></p>
    <?php
    //}else{
        ?>
      <!--  <h1>Login Failes</h1>
        <p>Something went wrong</p>
        <?php
    }
}  ?>/

  <!--  <form method="post" action="signup.php" >
        <h1 style="text-align:center;color:crimson">signup</h1>
        <label><h2>username</h2></label>
        <input type="text" placeholder="username" name="username" required>
        <label><h2>email-id</h2></label>
        <input type="text" placeholder="emailid"  name="emailid" required>
        <label><h2>password</h2></label>
        <input type="password" placeholder="password" name="password" required><br>
        <label><h2>Reenter Password</h2></label><br>
        <input type="password" placeholder="Reenter Password" name="psw-repeat" required>
        
        <br>
        <button>submit</button>
    </form>
</div>-->