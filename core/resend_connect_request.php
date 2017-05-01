<?php
include 'init.php';
session_start();

$conn_email = $_POST['conn_email'];
$patient_id = $_POST['patID'];
$threapist_id =$_SESSION["therapist_id"];

$date= date("Y-m-d");

$resend_connection =  "UPDATE connection_state  set request_date='$date' where therapist_id='$threapist_id' and patient_id='$patient_id'";
$resend = mysqli_query($conn, $resend_connection);

if(! $resend ) {
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
?>