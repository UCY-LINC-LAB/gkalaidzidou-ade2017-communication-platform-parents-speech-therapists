<?php
include 'init.php';

$conferenceID = $_POST['conference_id'];
$comments = $_POST['comments'];
$attention = $_POST['attention'];
$production = $_POST['production'];
$behavior = $_POST['behavior'];

//echo $conferenceID ;

$update_conference =  "UPDATE conference set comment='$comments' where conference_id='$conferenceID'";

$add_conference_score =  "INSERT INTO conference_score_bar (conference_id,title,score) VALUES ('$conferenceID','Prosoxh','$attention');";
$add_conference_score .=  "INSERT INTO conference_score_bar (conference_id,title,score) VALUES ('$conferenceID','Apodosh','$production');";
$add_conference_score .=  "INSERT INTO conference_score_bar (conference_id,title,score) VALUES ('$conferenceID','Simperifora','$behavior');";

$update = mysqli_query($conn, $update_conference);

if (mysqli_multi_query($conn, $add_conference_score) && $update) {

 	echo "<script>";
	echo " alert('Update done!');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
}else{
	echo "Error: " . $add_conference_score . "<br>" . mysqli_error($conn);
	echo "<script>";
	echo " alert('Please check again your update info.');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";

}
?>