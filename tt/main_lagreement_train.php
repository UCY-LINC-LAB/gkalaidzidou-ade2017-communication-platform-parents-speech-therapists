<?php
include 'init.php';

$rmentor=$_POST['r-mentor'];
$first_name=$_POST['t-fname'];
$last_name=$_POST['t-lname'];
$date = $_POST['t-bday'];
$nationality = $_POST['t-nationality'];
$gender = $_POST['t-sex'];
$study_cycle = $_POST['t-scycle'];
$field_of_study = $_POST['t-sfield'];

$scontact=$_POST['s-contact'];
$rcontact=$_POST['r-contact'];
$rinsti = $_POST['r-insti'];
$rdepart = $_POST['r-depart'];
$sinsti = $_POST['s-insti'];
$sdepart = $_POST['s-depart'];
$erasmus_code=$_POST['erasmus_code'];
$size=$_POST['size'];

$approved_app_num=$_SESSION['approved_app_number'];
$id= $_SESSION["user_ID"];
$app=$_SESSION['app_number'];

$personal_info = "UPDATE person set first_name='$first_name', last_name='$last_name', date_of_birth='$date', nationality='$nationality', gender='$gender' 
WHERE ID='$id' ";

$study_info="UPDATE application set study_cycle='$study_cycle', field_of_study='$field_of_study',institution='$sinsti' WHERE app_number='$app' ";

$main = "UPDATE learning_agreement_practice set  send_contact_person='$scontact', receiv_contact_person ='$rcontact',receiv_mentor='$rmentor',receiving_institution='$rinsti',erasmus_code='$erasmus_code',size='$size'
 WHERE approved_app_number='$approved_app_num'";

 if(mysql_query($main) && mysql_query($personal_info) && mysql_query($study_info)){
 	echo "<script>";
	echo " alert('Changes saved!');      
		    window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
} else{
	echo "<script>";
	echo " alert('Oops. Something went wrong. Please try again later');      
		    window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
}

?>