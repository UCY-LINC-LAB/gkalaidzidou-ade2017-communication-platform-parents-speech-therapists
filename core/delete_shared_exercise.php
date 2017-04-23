<?php
include 'init.php';
session_start();

$exercise_id = $_POST['ex_id'];
$patient_id = $_POST['pat_id'];

$deleteEx= "DELETE FROM patient_exercises WHERE patient_id='$patient_id' and exercise_id='$exercise_id'";
$delete = mysqli_query($conn, $deleteEx);

if (!$delete) { // add this check.
	die('Invalid query: ' . mysqli_error($conn));
	echo "<script>";
	echo " alert('Something is going wrong. Please try again.');      
		    window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";

}
else{
	echo "<script>";
	echo " alert('Delete done!');      
		    window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
}
?>