<?php include_once('lib/header.php'); 
      require_once('functions/alert.php');

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
  // redirect to  dashboard
  header("location: dashboard.php");
}
?> <p>
       <?php
          if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo "<span style ='color:red'>" . $_SESSION['error'] ."<span>";
            session_destroy();
          }
        ?>
      </p>

  <h3>Login</h3>
    <p>
       <?php print_alert();?>
      </p>
        <form action="processlogin.php" method="POST">
   
   <p>
    <label for="email">Email</label><br>
    <input 
    <?php
          if(isset($_SESSION['email'])){
            echo "value=" . $_SESSION['email'];
          }
      ?>
      type="email" name="email" placeholder="email" >
   </p>
   <p>
    <label for="password">Password</label><br>
    <input type="password" name="password" placeholder="password" >
   </p>
    <p>
       <button type="submit">Login</button>
    </p>
   </form>
  <?php include_once('lib/footer.php'); ?> 