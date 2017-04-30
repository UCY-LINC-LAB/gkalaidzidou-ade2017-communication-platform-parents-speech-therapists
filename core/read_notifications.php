<?php
include 'init.php';

$email = $_SESSION["email"];

$update_notif =  "UPDATE notification_box set state='1' where notif_to='$email'";

$update = mysqli_query($conn, $update_notif);
   
   if(! $update ) {
	echo "<script>";
	echo " alert('Please check again your update info.');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }else{
 	echo "<script>";
	echo " alert('Update done!');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }
?>