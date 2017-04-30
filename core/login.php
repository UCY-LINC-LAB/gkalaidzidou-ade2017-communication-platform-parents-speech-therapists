<?php
include 'init.php';

if (!empty($_POST["email"]) && !empty($_POST["password"])){     
  $email = $_POST["email"]; 
  $password = $_POST["password"]; 

  $check_login = mysqli_query($conn,"SELECT * FROM user WHERE email = '".$email."' AND  password = '".$password."'");

  if(mysqli_num_rows($check_login) > 0 ){   
    $result =  mysqli_fetch_array($check_login, MYSQLI_ASSOC);

    $_SESSION["logged_in"] = true; 
    $_SESSION['timeout'] = time();
    $_SESSION["email"] = $email; 
    $_SESSION['first_name'] =$result['first_name'];
    $_SESSION['last_name'] =$result['last_name'];
    $_SESSION["user_type"] = $result['type'];
    $_SESSION["passowrd"] = $result['password'];
    $_SESSION["telephone"] = $result['telephone'];

     //if the students dosent submit app form and the deadline has not end then get him tu app form
    if($_SESSION['user_type']=='therapist'){
        $therapist_data = mysqli_query($conn,"SELECT * FROM speech_therapist WHERE email = '".$email."'");
        $therapist_details =  mysqli_fetch_array($therapist_data, MYSQLI_ASSOC);

        $_SESSION["therapist_id"] = $therapist_details['therapist_id'];

        header('Location: ../home.php');
        exit;
    } else if($_SESSION['user_type']=='parent'){
        header('Location: ../homee.php');
        exit;
    }else{
     header('Location: ../login.php');
     exit;
   }
   
 }else{
    // remove all session variables
  session_unset();
    // destroy the session
  session_destroy(); 
  header("Location:".$_SERVER['HTTP_REFERER']."?wrong_login=true");
  exit;
}
}
?>
