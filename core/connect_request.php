<?php
include 'init.php';
session_start();

$conn_email = $_POST['conn_email'];
$patient_id = $_POST['patID'];
$threapist_id = '1';

$date= date("Y-m-d");
//echo $dateConf;


$parent_id=mysqli_query($conn,"SELECT user_id FROM user u where u.email='".$conn_email."' ");

   if(! $parent_id ) {
	echo "<script>";
	echo " alert('Please check again your insert.');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }else{

   	$id = mysqli_fetch_array($parent_id);
   	$parent_id= $id['user_id'];

   	$add_connection =  "INSERT INTO connection_state (therapist_id,patient_id,parent_id,request_date,request_state) 
   	VALUES ('$threapist_id','$patient_id','$parent_id','$date','1')";
   	$add = mysqli_query($conn, $add_connection);

   	if(! $add ) {
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

/*
$add_connection =  "INSERT INTO connection_state (conference_date,therapist_id,patient_id,start_time,end_time,target_description) VALUES ('$dateConf','$threapist_id','$patient', '$startTime','$endTime', '$targetDescription')";

$add = mysqli_query($conn, $add_conference);

   if(! $add ) {
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

   */
?>