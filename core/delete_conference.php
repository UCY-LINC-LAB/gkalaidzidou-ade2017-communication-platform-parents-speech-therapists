<?php
include 'init.php';
$confId = $_POST['conference_id'];

$deleteConference = "DELETE FROM conference WHERE conference_id='4'";
$delete = mysqli_query($conn, $deleteConference);

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