<?php
include 'init.php';
session_start();

$conn_email = $_POST['conn_email'];
$patient_id = $_POST['patID'];
$threapist_id = $_SESSION["therapist_id"];
$email=$_SESSION["email"];
$date= date("Y-m-d");

   	$add_connection =  "INSERT INTO connection_state (therapist_id,patient_id,request_date,request_state) 
   	VALUES ('$threapist_id','$patient_id','$date','1')";
   	$add = mysqli_query($conn, $add_connection);

   	if(! $add ) {
		echo "<script>";
		echo " alert('Please check again your insert.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
   }else{
   	   	$add_connect_notification ="INSERT INTO notification_box (notif_from,notif_to,notif_type,send_date) VALUES ('$email','$conn_email','connect','$date')";
   		$add_notif = mysqli_query($conn, $add_connect_notification);

   		if(! $add_notif ) {
   			 die('Invalid query: ' . mysqli_error($conn));
			echo "<script>";
			echo " alert('Please check again your insert.');      
			window.location.href='". $_SERVER['HTTP_REFERER']."';
			</script>";
  		 }else{
  		 	echo "<script>";
			echo " alert('Insert done!');      
			window.location.href='". $_SERVER['HTTP_REFERER']."';
			</script>";
   		}
   }	
?>