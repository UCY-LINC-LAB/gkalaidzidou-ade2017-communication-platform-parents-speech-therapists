<?php
include 'init.php';

$conferenceID = $_POST['eventID'];
echo $conferenceID;


$deleteConferenceScore = "DELETE FROM conference_score_bar WHERE conference_id='$conferenceID'";
$delete1 = mysqli_query($conn, $deleteConferenceScore);


$deleteConference = "DELETE FROM conference WHERE conference_id='$conferenceID'";
$delete2 = mysqli_query($conn, $deleteConference);

if (!$delete1 && !$delete2) { // add this check.
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