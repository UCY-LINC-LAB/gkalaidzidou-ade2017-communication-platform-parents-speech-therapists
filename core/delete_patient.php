<?php
include 'init.php';

$deletePatient = "DELETE FROM patient WHERE patient_id='4'";
$delete = mysqli_query($conn, $deletePatient);

if (!$delete) { // add this check.
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