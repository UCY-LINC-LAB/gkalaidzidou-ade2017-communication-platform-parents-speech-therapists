<?php
include 'init.php';

$first_name=$_POST['sfname'];
$last_name=$_POST['slname'];
$date = $_POST['sbday'];
$nationality = $_POST['snationality'];
$gender = $_POST['ssex'];
$study_cycle = $_POST['sscycle'];
$field_of_study = $_POST['ssfield'];

$scontact=$_POST['s-contact'];
$rcontact=$_POST['r-contact'];
$rinsti = $_POST['r-insti'];
$rdepart = $_POST['r-depart'];
$sinsti = $_POST['s-insti'];
$sdepart = $_POST['s-depart'];
$receive_erasmus_code=$_POST['receive_erasmus_code'];
$send_erasmus_code=$_POST['send_erasmus_code'];

$approved_app_num=$_SESSION['approved_app_number'];
$id= $_SESSION["user_ID"];
$app=$_SESSION['app_number'];

$personal_info = "UPDATE person set first_name='$first_name', last_name='$last_name', date_of_birth='$date', nationality='$nationality', gender='$gender' 
WHERE ID='$id' ";

$study_info="UPDATE application set study_cycle='$study_cycle', field_of_study='$field_of_study' WHERE app_number='$app'  ";

$main = "UPDATE learning_agreement_study set  send_contact_person='$scontact', receiv_contact_person ='$rcontact',receive_erasmus_code='$receive_erasmus_code',send_erasmus_code='$send_erasmus_code',
receiving_institution='$rinsti' WHERE approved_app_number='$approved_app_num'";

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