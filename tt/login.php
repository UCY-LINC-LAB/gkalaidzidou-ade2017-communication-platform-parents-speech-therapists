<?php
include 'init.php';

if (!empty($_POST["email"]) && !empty($_POST["password"])){     
  $email = $_POST["email"]; 
  $password = $_POST["password"]; 

  $check_login = mysql_query("SELECT email,password,type,active,submitted FROM user WHERE email = '".$email."' AND  password = '".$password."'");

  if(mysql_num_rows($check_login) > 0 ){   
    $result =  mysql_fetch_array($check_login, MYSQL_ASSOC);
    $name = mysql_query("SELECT ID,first_name,last_name FROM person WHERE email = '".$email."' ");
    $row =  mysql_fetch_array($name, MYSQL_ASSOC);
    $deadlines=  mysql_fetch_array(mysql_query("SELECT app_start_date,app_end_date FROM deadlines"),MYSQL_ASSOC);

    if($result['type']!='Incoming Student' && $result['type']!='Outgoing Student'){
      $t = mysql_query("SELECT department FROM employee WHERE employee_id = '".$row['ID']."' ");
      $t =  mysql_fetch_array($t, MYSQL_ASSOC);
      $_SESSION["department"] = $t['department'];
    }

    $current=date("Y");
    $next=$current+1;
    $academic_year=$current.'-'.$next;

    $movement_type = mysql_fetch_array(mysql_query("SELECT type,app_number FROM application where academic_year='$academic_year' and student_id='".$row['ID']."'"),MYSQL_ASSOC);

    $_SESSION["logged_in"] = true; 
    $_SESSION['timeout'] = time();
    $_SESSION["email"] = $email; 
    $_SESSION['first_name'] =$row['first_name'];
    $_SESSION['last_name'] =$row['last_name'];
    $_SESSION['fullname'] = $row['first_name'] . " ". $row['last_name'];
    $_SESSION["user_type"] = $result['type'];
    $_SESSION["user_ID"] = $row['ID'];
    $_SESSION["active"] = $result['active'];
    $_SESSION["submitted"] = $result['submitted'];
    $_SESSION["passowrd"] = $result['password'];
    $_SESSION["academic_year"]=$academic_year;
    $_SESSION["movement_type"]= $movement_type['type'];

    $today = date("Y-m-d");
    $start = $deadlines['app_start_date'];
    $end =$deadlines['app_end_date'];

    $today_time = strtotime($today);
    $start_time = strtotime($start);
    $end_time = strtotime($end);

    echo $today_time."  ";
    echo $start_time."  ";
    echo $end_time."  ";

    if ($today_time <= $end_time && $today_time >= $start_time ) 
      $_SESSION["open"]=true; 
    else
      $_SESSION["open"]=false;

     //if the students dosent submit app form and the deadline has not end then get him tu app form
    if($_SESSION['user_type']=='Incoming Student'){
      if(($_SESSION['open']==true) && ($_SESSION['submitted']==false)){
        header('Location: ../inStudent_app_form.php');
      }
      else if ($_SESSION['active']==true) {//else if he is active erasmus student then get him to lagreement page
        if($movement_type['type']=='practice')
          header('Location: ../lagreement_for_traineeship.php');
        else
          header('Location: ../lagreement_for_study.php');
      } else{
        header('Location: ../inStudent.php');
      }
    }

    else if($_SESSION['user_type']=='Outgoing Student'){
    if(($_SESSION['open']==true) && ($_SESSION['submitted']==false)){
        header('Location: ../outStudent_app_form.php');
      }
      else if ($_SESSION['active']==true) {//else if he is active erasmus student then get him to lagreement page
        if($movement_type['type']=='practice')
          header('Location: ../lagreement_for_traineeship.php');
        else
          header('Location: ../lagreement_for_study.php');
      } else{
        header('Location: ../oStudent.php');
      }
   }
   else if($_SESSION['user_type']=='Secretary'){
     header('Location: ../secretary.php');
   }
   else if($_SESSION['user_type']=='Academic Coordinator'){
     header('Location: ../academic_coordinator.php');
   }
   else if($_SESSION['user_type']=='Erasmus Office'){
      header('Location: ../erasmus_office.php');
   }
   else if($_SESSION['user_type']=='Administrator'){
      header('Location: ../administrator.php');
   }
   else{
     header('Location: ../e-login.php');
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
