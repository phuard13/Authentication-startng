<?php session_start();
  
include_once('lib/header.php'); 
?>
  <h3>Register</h3>
  <p><strong>Welcome, Please Register Here</strong></p>
  <p>All fields are </p>


   <form action="processregister.php" method="POST">
   <p>
        <?php
          if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo "<span style ='color:red'>" . $_SESSION['error'] . "</span>";

            // session_unset();
            session_destroy();
          }
        ?>
   </p>
   <p>
    <label for="first_name">First Name</label><br>
    <input 
      <?php
          if(isset($_SESSION['first_name'])){
            echo "value=" . $_SESSION['first_name'];
          }
      ?>
    type="text" name="first_name" placeholder="first name" >
   </p>
   <p>
    <label for="last_name">Last Name</label><br>
    <input 
    <?php
          if(isset($_SESSION['last_name'])){
            echo "value=" . $_SESSION['last_name'];
          }
      ?>
       type="text" name="last_name" placeholder="last name" >
   </p>
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
    <label for="gender">Gender</label><br>
    <select name="gender" >
    <option value="">Select One</option>
    <option 
    <?php
          if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
            echo "selected";
          }
      ?>
    >Female</option>
    <option 
    <?php
      if(isset($_SESSION["gender"]) && $_SESSION['gender'] == 'Male'){
        echo "selected";
      }
    ?>
    >Male</option>
    <option
    <?php
      if(isset($_SESSION["gender"]) && $_SESSION['gender'] == 'Others'){
        echo "selected";
      }
    ?>
    >Others</option>
    </select>
   </p>
   <p>
    <label for="">Designation</label><br>
    <select name="designation" >
    <option value="">Select One</option>
    <option
    
    <?php
      if(isset($_SESSION["designation"]) && $_SESSION['designation'] == "Medical Team (MT)"){
        echo "selected";
      }
    ?>>Medical Team (MT)</option>
    <option
    <?php
      if(isset($_SESSION["designation"]) && $_SESSION['designation'] == 'Patient'){
        echo "selected";
      }
    ?>
    >Patient</option>
    </select>
   </p>
   <p>
    <label>Department</label><br>
    <input 
    <?php
          if(isset($_SESSION['deoartment'])){
            echo "value=" . $_SESSION['department'];
          }
      ?>
    
    type="text" name="department" placeholder="Department" >
   </p>
    <p>
       <button type="submit">Register</button>
    </p>
   </form>



  <?php include_once('lib/footer.php'); ?>