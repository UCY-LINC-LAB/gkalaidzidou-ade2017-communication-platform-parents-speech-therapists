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
    $_SESSION['fullname'] = $result['first_name'] . " ". $result['last_name'];
    $_SESSION["user_type"] = $result['type'];
    $_SESSION["user_ID"] = $result['user_id'];
    $_SESSION["passowrd"] = $result['password'];

     //if the students dosent submit app form and the deadline has not end then get him tu app form
    if($_SESSION['user_type']=='therapist'){
        header('Location: ../home.php');
    } else if($_SESSION['user_type']=='parent'){
        header('Location: ../home.php');
    }else{
     header('Location: ../login.php');
   }
 }
 else{
    // remove all session variables
  session_unset();
    // destroy the session
  session_destroy(); 
  header("Location:".$_SERVER['HTTP_REFERER']."?wrong_login=true");
}
}
?>
