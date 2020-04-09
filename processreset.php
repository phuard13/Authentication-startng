<?phpsession_start(); 


// data collection
$errorCount = 0;
if(!$_SESSION['loggedIn']){
   
  $token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;
  $_SESSION['token'] = $token;
}

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

 
$_SESSION['email'] = $email;

if($errorCount > 0){


  $session_error = "You have " . $errorCount . " error" ;

  if($errorCount > 1) { 
    $session_error .= "s";
  }

   $session_error .= " in your form submission";
   $_SESSION["error"] = $session_error ;

    header("Location: reset.php");
 
}else{
  //  TODO: do actual reset here
  // check if email is registered in token folder
  // check if the content of the registered token(in folder), is the same as token
  $allUserTokens =  scandir("db/tokens/");
  $countAllUserTokens = count($allUserTokens);
   
  for ($counter = 0; $counter < $countAllUserTokens ; $counter++){

    $currentTokenFile = $allUserTokens[$counter];

    if($currentTokenFile == $email . ".json" ){
    //  now check if the token in the currentTokenFile is the same as $token
    $tokenContent = file_get_contents("db/tokens/" .$currentTokenFile);        
    $tokenObject = json_decode($tokenContent);
    $tokenFromDB = $tokenObject -> token;
      
      //  TODO: To make it better
      if($_SESSION['loggedIn']){
          $checkToken = true;

      }else{
        $checkToken = $tokenFromDB ==$token;
      }


    if($checkToken){
         
      $allUsers = scandir("db/users/");  
      $countAllUsers = count($allUsers);  

      for($counter = 0; $counter < $countAllUsers ; $counter++) {
        $currentUser = $allUsers[$counter];
     
        if($currentUser == $email . ".json" ){
          // check for password
          $userString = file_get_contents("db/users/" .$currentUser);        
          $userObject = json_decode($userString);

          $userObject -> password = password_hash($password, PASSWORD_DEFAULT);
          
          // file delete user data deleted
          unlink("db/users/" .$currentUser);  
          
          file_put_contents("db/users/". $email . ".json", json_encode($userObject));

          $_SESSION["message"] = "Password Reset Successful, you can now login ";

          // inform user via mail that password change was successful

              $subject = "Password Reset Successful";
              $message = "Your pasword was successfully updated , if you didnt make this change kindly visit our website www.startngphptask2.com";
              $headers = "From: no-reply@task2.org" . "\r\n" .
              "CC: mee@task2.org";
 
              $try = mail($email,$subject,$message,$headers);

              // inform user via mail password change successful closes here

          header("Location: login.php");
          die();

         }
    
        }

       }
      }
     }

    $_SESSION["error"] = "token or email invalid " . ;
   header("Location: login.php");
}
