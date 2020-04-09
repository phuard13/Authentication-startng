<?php 
 
     include_once('lib/header.php'); 
     require_once('functions/alert.php');
     require_once('functions/user.php');
     
    // if user is not loggedin | if token is set | if user session token is not set | then show error response  
      if(!is_user_loggedIn() && !is_token_set()){
       $_SESSION['error'] = "You not authorize to view that page";
       header("location: login.php");
       die();
      }
     
     ?>
    
    <h3>Reset Password</h3>
    <p>Reset password associated with your account ! [email]</p>

    <form action="processreset.php" method="POST">
    <p>
        <?php
         print_alert();
        ?>
   </p> 
    <?php if(!is_user_loggedIn()){ ?>
     <input 
        <?php
         if(is_token_set_in_session()){
           echo "value= '" . $_SESSION['token'] . "'";
         }else{
            echo "value= '" . $_GET['token'] . "'";
         }
        ?>    
            type="hidden" name="token">
        <?php } ?>    
     <p>  
        <label>Email</label><br>
        <input 
        <?php
            if(isset($_SESSION['email'])){
             echo "value=" . $_SESSION['email'];
            }
        ?>
        type="email" name="email" placeholder="email"> 
     </p>
     <p>
        <label>Enter New Password</label><br>
        <input type="password" name="password" placeholder="password" >
   </p>

     <p>
       <button type="submit">Reset Password</button>
    </p>
    
    </form>
 
 <?php include_once('lib/footer.php');?>