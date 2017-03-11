<?php
include 'init.php';

$conferenceID = $_POST['eventID'];

$deleteConference = "DELETE FROM conference WHERE conference_id='$conferenceID'";
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