<?php
include 'init.php';

$conferenceID = $_POST['eventID'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$targetDescription = $_POST['targetDescription'];
$patient = $_POST['patient'];
$comments=$_POST['comments'];

$attention = $_POST['attention'];
$production = $_POST['production'];
$behavior = $_POST['behavior'];

$dateConf= date("Y-m-d",strtotime($_POST['date']));
$today = date("Y-m-d H:i:s");

$update_conference =  "UPDATE conference set conference_date= '$dateConf',start_time='$startTime' ,end_time='$endTime',target_description='$targetDescription', patient_id='$patient', comment='$comments' where conference_id='$conferenceID'";

$update = mysqli_query($conn, $update_conference);

$count = mysqli_query($conn,"SELECT COUNT( DISTINCT conference_id) AS count FROM conference_score_bar where conference_id='$conferenceID'");

if (!$count) { // add this check.
    die('Invalid query: ' . mysql_error());
}else{
	$count_insertion = mysqli_fetch_array($count);
	echo $count_insertion['count'];
}


if($count_insertion['count']==3){

	$update_conference_score1 =  "UPDATE conference_score_bar set score= '$attention' where conference_id='$conferenceID' and title='Prosoxh' ";
	$update_conference_score2 =  "UPDATE conference_score_bar set score= '$production' where conference_id='$conferenceID' and title='Apodosh' ";
	$update_conference_score3 =  "UPDATE conference_score_bar set score= '$behavior' where conference_id='$conferenceID' and title='Simperifora' ";

	$update1 = mysqli_query($conn, $update_conference_score1);
	$update2 = mysqli_query($conn, $update_conference_score2);
	$update3 = mysqli_query($conn, $update_conference_score3);
}else if($dateConf<$today){
	$add_conference_score =  "INSERT INTO conference_score_bar (conference_id,title,score) VALUES ('$conferenceID','Prosoxh','$attention');";
	$add_conference_score .=  "INSERT INTO conference_score_bar (conference_id,title,score) VALUES ('$conferenceID','Apodosh','$production');";
	$add_conference_score .=  "INSERT INTO conference_score_bar (conference_id,title,score) VALUES ('$conferenceID','Simperifora','$behavior');";
}

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