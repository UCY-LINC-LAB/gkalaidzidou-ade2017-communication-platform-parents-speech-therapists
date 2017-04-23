<?php
include 'init.php';
session_start();

$exercise_id = $_POST['exer_id'];
$patient=$_POST['patient'];
$exer_guide = $_POST['exer_guide'];
$therapist_id = '1';

$today = date("Y-m-d H:i:s");

$insert_exercise = "INSERT INTO patient_exercises (exercise_id,patient_id,listing_date, guide) VALUES ('$exercise_id','$patient','$today', '$exer_guide')";
$insert_ex = mysqli_query($conn, $insert_exercise);
   
if(! $insert_ex ) {
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