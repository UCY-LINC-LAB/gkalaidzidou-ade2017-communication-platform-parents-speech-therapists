<?php
include 'init.php';

$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$targetDescription = $_POST['targetDescription'];
$patient = $_POST['patient'];
$threapist_id = '1';

$dateConf= date("Y-m-d",strtotime($_POST['date']));

$update_conference =  "UPDATE conference set conference_date= '$dateConf',start_time='$startTime' ,end_time='$endTime',target_description='$targetDescription' where
 threapist_id='$threapist_id' and patient_id='$patient_id'";

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