<?php
include 'init.php';
session_start(); 

$app_num = $_GET['num'];
$st = $_GET['status'];
$user_id= $_SESSION["user_ID"];
$insti="University of Crete";

$updateStatus = "UPDATE application set status='$st' where app_number='$app_num'";
$result=mysql_query($updateStatus) or die(mysql_error());

$searchEmail = mysql_query("SELECT p.email,a.type FROM person p, application a WHERE a.app_number='$app_num' and a.student_id=p.ID");
$result =  mysql_fetch_array($searchEmail, MYSQL_ASSOC);

$email=$result['email'];
$type=$result['type'];

$approved_num = mysql_fetch_array(mysql_query("SELECT approved_app_number FROM approved_application where app_number='$app_num'"),MYSQL_ASSOC);
$approved_num=$approved_num['approved_app_number'];

if($type=='practice'){
$lagree_code = mysql_fetch_array(mysql_query("SELECT code FROM learning_agreement_practice where approved_app_number='$approved_num'"),MYSQL_ASSOC);
$lagree_code =$lagree_code['code'];
}
else{
$lagree_code = mysql_fetch_array(mysql_query("SELECT code FROM learning_agreement_study where approved_app_number='$approved_num'"),MYSQL_ASSOC);
$lagree_code =$lagree_code['code'];
}

if($st=='approved'){
	$makeActive = "UPDATE user set active='1' where email='$email'";
	$result=mysql_query($makeActive) or die(mysql_error());

	$today = date("Y-m-d H:i:s");

	$approveApp="INSERT INTO approved_application (app_number,employee_id,approved_date) VALUES ('$app_num','$user_id','$today')";
	$result=mysql_query($approveApp) or die(mysql_error());

	$approved_num = mysql_fetch_array(mysql_query("SELECT approved_app_number FROM approved_application WHERE app_number='$app_num'"),MYSQL_ASSOC);
	$approved_num=$approved_num['approved_app_number'];

	if($type=='practice'){
		$createLagree="INSERT INTO learning_agreement_practice (approved_app_number,receiving_institution) VALUES ('$approved_num','$insti')";
		$result=mysql_query($createLagree) or die(mysql_error());

		$lagree_code = mysql_fetch_array(mysql_query("SELECT code FROM learning_agreement_practice WHERE approved_app_number='$approved_num'"),MYSQL_ASSOC);
		$lagree_code =$lagree_code ['code'];

		$createLagreeDetails="INSERT INTO practice_details (phase,lagreement_code) VALUES ('Before','$lagree_code'),('During','$lagree_code'),('After','$lagree_code')";
		$result=mysql_query($createLagreeDetails) or die(mysql_error());
	}
	else{
		$createLagree="INSERT INTO learning_agreement_study(approved_app_number,receiving_institution) VALUES ('$approved_num','$insti')";
		$result=mysql_query($createLagree) or die(mysql_error());

		$lagree_code = mysql_fetch_array(mysql_query("SELECT code FROM learning_agreement_study WHERE approved_app_number='$approved_num'"),MYSQL_ASSOC);
		$lagree_code =$lagree_code ['code'];

		$createLagreeDetails="INSERT INTO study_details (lagreement_code) VALUES ('$lagree_code')";
		$result=mysql_query($createLagreeDetails) or die(mysql_error());
	}
}
else{
	$makeActive = "UPDATE user set active='0' where email='$email'";
	$result=mysql_query($makeActive) or die(mysql_error());

	if($type=='practice'){
		$deleteLagreeDetails="DELETE FROM practice_details  WHERE lagreement_code='$lagree_code'";
		$result=mysql_query($deleteLagreeDetails) or die(mysql_error());

		$deleteLagree="DELETE FROM learning_agreement_practice  WHERE approved_app_number='$approved_num'";
		$result=mysql_query($deleteLagree) or die(mysql_error());
	}
	else{
		$deleteLagreeDetails="DELETE FROM study_details  WHERE lagreement_code='$lagree_code'";
		$result=mysql_query($deleteLagreeDetails) or die(mysql_error());

		$deleteLagree="DELETE FROM learning_agreement_study  WHERE approved_app_number='$approved_num'";
		$result=mysql_query($deleteLagree) or die(mysql_error());
	}
	$cancelApproved="DELETE FROM approved_application  WHERE app_number='$app_num'";
	$result=mysql_query($cancelApproved) or die(mysql_error());
}	
 ?>