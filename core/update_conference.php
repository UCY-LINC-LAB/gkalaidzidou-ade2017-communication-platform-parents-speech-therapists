<?php
include 'init.php';

$conferenceID = $_POST['eventID'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$targetDescription = $_POST['targetDescription'];
$patient = $_POST['patient'];

$dateConf= date("Y-m-d",strtotime($_POST['date']));

$update_conference =  "UPDATE conference set conference_date= '$dateConf',start_time='$startTime' ,end_time='$endTime',target_description='$targetDescription', patient_id='$patient' where conference_id='$conferenceID'";

$update = mysqli_query($conn, $update_conference);

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