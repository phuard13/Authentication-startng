<?php session_start(); 
      require_once('functions/alert.php');

// data collection
$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$_SESSION['email'] = $email;

if($errorCount > 0){


  $session_error = "You have " . $errorCount . " error" ;

  if($errorCount > 1) { 
    $session_error .= "s";
  }

   $session_error .= " in your form submission";
   set_alert("error" , $session_error);

    header("Location: forgot.php");
 
}else{
    
      $allUsers =  scandir("db/users/");
      $countAllUsers = count($allUsers);
       
      for ($counter = 0; $counter < $countAllUsers ; $counter++){

        $currentUser = $allUsers[$counter];
 
        if($currentUser == $email . ".json" ){

        //  $_SESSION["message"] = "reset sent check your mail ";
 
        //  header("Location: forgot.php");
 
        //  die();

        // sending mail on how to redirect password
              

            //  generating token code start here
            $token = "";

            $alphabets = ['a','b','c','d','e','f','g','h','i','j','A','B','C','D','E','F','G','H','I','J'];
                for($i = 0; $i<26; $i++){
               // get a random number
               //  get element in alphabets at the index of random number
              //  add that to the token string
               $index = mt_rand(0,count($alphabets)-1);
               $token = $alphabets[$index];
                }
                
              $subject = "Password Reset Link";
              $message = "Password reset has been initiated from your account. If you didnt request for reset, Kindly ignore this message, otherwise, visit: localhost/startngphptask2/reset.php?token=".$token;
              $headers = "From: no-reply@task2.org" . "\r\n" .
              "CC: mee@task2.org";
 
              $try = mail($email,$subject,$message,$headers);
                 
              if($try){
                //  display message if successful
                          
                  $_SESSION["message"] = "Password reset sent to your email: " . $email;
                  header("Location: login.php");
              }else{
                                    
                $_SESSION["error"] = "Something went wrong reset failed: " . $email;
                header("Location: forgot.php");

              }
               die();
          }
  
         }

         $_SESSION["error"] = "Email not found ERR: " . $email;
         header("Location: forgot.php");
}