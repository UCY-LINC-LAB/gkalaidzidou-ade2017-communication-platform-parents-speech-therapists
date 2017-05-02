<?php
include 'init.php';
session_start();

$patient_com = $_POST['patient_com'];
$patient_id=$_SESSION["patient_id"];
$exercise_id=$_POST['ex_id'];

$update_com =  "UPDATE patient_exercises set parent_comment='$patient_com' where patient_id='$patient_id' and exercise_id='$exercise_id'";

$update = mysqli_query($conn, $update_com);
   
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