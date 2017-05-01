<?php
include 'init.php';
session_start();

$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$targetDescription = $_POST['targetDescription'];
$patient = $_POST['patient'];
$threapist_id =$_SESSION["therapist_id"];

$dateConf= date("Y-m-d",strtotime($_POST['date']));

mysqli_query( $conn,"SET NAMES 'utf8'");

$add_conference =  "INSERT INTO conference (conference_date,therapist_id,patient_id,start_time,end_time,target_description) VALUES ('$dateConf','$threapist_id','$patient', '$startTime','$endTime', '$targetDescription')";

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
?>