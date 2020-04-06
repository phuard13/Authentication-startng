<?php session_start(); 


// data collection
$errorCount = 0;
// verifying the data and validation
$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] : $errorCount++;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] : $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorCount++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorCount++; 
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++;

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name; 
$_SESSION['email'] = $email;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;

if($errorCount > 0){


    $session_error = "You have " . $errorCount . " error" ;
  
    if($errorCount > 1) { 
      $session_error .= "s";
    }
  
     $session_error .= " in your form submission";
     $_SESSION["error"] = $session_error ;
  
      header("Location: register.php");
   
}else{
      // count all users
      //  assign ID to user
      // assign id to the  new user
      $allUsers =  scandir("db/users/");
      $countAllUsers = count($allUsers);
     
      $newUserId = ($countAllUsers-1);

   $userObject = [
     'id' =>$newUserId,
     'first_name' =>$first_name,
     'last_name' =>$last_name,
     'email' =>$email,
    //  password encrytion cant been seen even in the db file system
     'password' =>password_hash($password, PASSWORD_DEFAULT),   
     'gender' =>$gender,
     'designation' =>$designation,
     'department' =>$department
   ];
    
  //  check if user already exist in the file system below we had to change $first_name,$last_name and use email instead
  // Also to check if the allUsers array and check if email already exist
   
     for ($counter = 0; $counter < $countAllUsers ; $counter++){

       $currentUser = $allUsers[$counter];

       if($currentUser == $email . ".json" ){

        $_SESSION["error"] = "User already exist ";

        header("Location: register.php");

        dir();

         }

        }

  // save to the databse
  file_put_contents("db/users/". $email . ".json", json_encode($userObject));
  $_SESSION["message"] = "Registration Successful, Login " . $first_name;
  header("Location: login.php");
  }