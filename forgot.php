<?php include_once('lib/header.php'); 
      require_once('functions/alert.php');
  ?>
    
    <h3>Forgot password</h3>
    <p>Provide email address</p>

    <form action="processforgot.php" method="POST">
    <p>
        <?php
          print_alert();
        ?>
   </p> 
     <p>  
        <label for="email">Email</label><br>
        <input 
        <?php
            if(isset($_SESSION['email'])){
                echo "value=" . $_SESSION['email'];
            }
        ?>
        type="email" name="email" placeholder="email">
        
     </p>
     <p>
       <button type="submit">submit</button>
    </p>


    </form>
 
 <?php include_once('lib/footer.php');?>