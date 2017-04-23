<?php
include 'init.php';

$guide = $_POST['guide'];
$exercise_id = $_POST['exercise_id'];
$patient_id = $_POST['patient_id'];

$update_shared_ex =  "UPDATE patient_exercises set guide='$guide' where patient_id='$patient_id' and exercise_id='$exercise_id'";

$update = mysqli_query($conn, $update_shared_ex);
   
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