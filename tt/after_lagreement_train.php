<?php
include 'init.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$train_title = $_POST['train_title'];
$programme=$_POST['programme'];
$skills = $_POST['skills'];
$evalPlan = $_POST['evalPlan'];

$approved_app_num=$_SESSION['approved_app_number'];
$lagreement_code=$_SESSION['lagreement_code'];

$during_lagreement_insert ="UPDATE learning_agreement_practice set start_date='$start_date',end_date='$end_date'WHERE approved_app_number='$approved_app_num'";

$practice_details ="UPDATE practice_details set traineeship_title='$train_title', skills='$skills',evaluation_plan='$evalPlan', program_details='$programme' where lagreement_code='$lagreement_code' and phase='After'";

if(mysql_query($during_lagreement_insert) && mysql_query($practice_details)){
	echo "<script>";
	echo " alert('Changes saved!');      
		    window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
} else{
	echo "<script>";
	echo " alert('Oops. Something went wrong. Please try again later');      
		    window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
		}
?>