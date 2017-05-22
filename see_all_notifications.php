<?php
include 'core/init.php';
session_start(); 

if ( $_SESSION['logged_in'] != true || $_SESSION['user_type']!='therapist'){
  header('Location: login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>logoucon | ειδοποιήσεις</title>
  <link rel="icon" type="image/png" href="img/icon.png">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

  <body>
  <?php include_once('navbar.php');?>
  <div class="container">
  	<h4>Οι ειδοποιήσεις σας</h4>
  	<hr>
  	   <div class="">

    <?php 
    $notification = mysqli_query($conn,"SELECT  distinct * FROM notification_box as nb,user as u where nb.notif_to='".$_SESSION["email"]."' and u.email=nb.notif_from ORDER BY nb.send_date DESC");

    if (!$notification) { // add this check.
      die('Invalid query: ' . mysql_error());
    }
    while ($notification_list = mysqli_fetch_array($notification)) { 

      if($notification_list["notif_type"]=="comment"){?>
       <div class="">
        <a  href="#"><h4 class="item-title"><img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg"><b><?php echo " ".$notification_list['first_name']." ".$notification_list['last_name']; ?></b> σχολιάσε την άσκηση</h4></a>
        <p class="item-info" style="color: grey; margin-left: 17px;"><i class="fa fa-comment" aria-hidden="true" style="margin-right:7px; "></i><?php echo date('j',strtotime($notification_list['date'])) . ' ' .$greekMonths[intval(date('m',strtotime($notification_list['date'])))-1]; ?></p>
      </div>
   
    <?php }else{?>


       <div class="">
        <a  href="#"><h4 class="item-title"><img style='height: 20px; width: 20px;' class="img-circle" src="img/profile.jpg"><b><?php echo " ".$notification_list['first_name']." ".$notification_list['last_name']; ?></b> έχει συνδεθεί μαζί σας.</h4></a>
        <p class="item-info" style="color: grey; margin-left: 17px;"><i class="fa fa-user" aria-hidden="true" style="margin-right:7px; "></i><?php echo date('j',strtotime($notification_list['date'])) . ' ' .$greekMonths[intval(date('m',strtotime($notification_list['date'])))-1]; ?></p>
      </div>
     <?php }?>
      <hr>
    <?php }?>
   </div>
  </div>
  </body>
  </html>