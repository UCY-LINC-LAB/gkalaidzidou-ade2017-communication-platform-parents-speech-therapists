<?php
include 'init.php';
session_start();

$email=$_SESSION["email"];
$date= date("Y-m-d");

$details = mysqli_query($conn,"SELECT * FROM patient WHERE email='".$email."'");
$details_list = mysqli_fetch_assoc($details);

$therapist=$details_list['therapist_id'];
$patient=$details_list['patient_id'];

$update_connection ="UPDATE connection_state set connection_state= '1',connection_date='$date' where therapist_id='$therapist' and patient_id='$patient'";

   	$update = mysqli_query($conn, $update_connection);

   	if(! $update ) {
   		 die('Invalid query: ' . mysql_error());
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
?>