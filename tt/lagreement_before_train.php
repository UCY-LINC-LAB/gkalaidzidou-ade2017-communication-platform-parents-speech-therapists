<?php
include 'init.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$train_title = $_POST['train_title'];
$hours = $_POST['hours'];
$detailed_programme = $_POST['detailed_programme'];
$skills = $_POST['skills'];
$initialPhase = $_POST['initialPhase'];
$duringPhase = $_POST['duringPhase'];
$endPhase = $_POST['endPhase'];
$evalPlan = $_POST['evalPlan'];

$lang_competence = $_POST['lang_competence'];
$lang = $_POST['lang'];
$box=$_POST['box'];

$gradebased = $_POST['grade_basedOn'];
$transcriptAndDiploma = $_POST['transcriptAndDiploma'];
$euroMobilityDoc = $_POST['euroMobilityDoc'];
$aCredits = $_POST['aCredits'];
$grade = $_POST['grade'];
if($box=='2')
$total_ECTS=$_POST['total_ECTS2'];
else if($box=='3')
$total_ECTS=$_POST['total_ECTS3'];

$transcriptR = $_POST['transcriptR'];

$accidentIns = $_POST['accidentIns'];
$accidentInTravel = $_POST['accidentInTravel'];
$accidentInWork = $_POST['accidentInWork'];
$liabilityIn = $_POST['liabilityIn'];

$finSupport = $_POST['finSupport'];
$amount = $_POST['amount'];
$contribution = $_POST['contribution'];
$rAccidentIn = $_POST['rAccidentIn'];
$rAccidentInTravel = $_POST['rAccidentInTravel'];
$rAccidentInWork = $_POST['rAccidentInWork'];
$rliabilityIns = $_POST['rliabilityIns'];
$apprSupport = $_POST['apprSupport'];

$approved_app_num=$_SESSION['approved_app_number'];
$lagreement_code=$_SESSION['lagreement_code'];

$scontact=$_POST['s_contact_info'];
$rcontact=$_POST['r_contact_info'];

$before_lagreement_insert ="UPDATE learning_agreement_practice set start_date='$start_date',end_date='$end_date',language_competence='$lang_competence', language_level='$lang', grade_basedOn='$gradebased', 
transcriptAndDiploma='$transcriptAndDiploma', euroMobilityDoc='$euroMobilityDoc', ECTS_credits='$aCredits',total_ECTS='$total_ECTS',grade='$grade', transcript='$transcriptR', send_accInsu='$accidentIns',  
send_accOnWay='$accidentInTravel', send_accDuring='$accidentInWork', send_liabilityInsu='$liabilityIn', fin_support='$finSupport',amount = '$amount',contribution='$contribution',
receiv_accInsu='$rAccidentIn', receiv_accDuring='$rAccidentInTravel', receiv_accOnWay='$rAccidentInWork', receiv_liabilityInsu='$rliabilityIns', appro_support='$apprSupport', tableB_box='$box',send_contact_person='$scontact', receiv_contact_person ='$rcontact' WHERE approved_app_number='$approved_app_num'";

$practice_details ="UPDATE practice_details set traineeship_title='$train_title',working_hours='$hours',program_details='$detailed_programme', skills='$skills', 
initial_phase='$initialPhase',during_phase='$duringPhase',end_phase='$endPhase',evaluation_plan='$evalPlan' where lagreement_code='$lagreement_code' and phase='Before'";

if(mysql_query($before_lagreement_insert) && mysql_query($practice_details)){
	echo "<script>";
	echo " alert('Changes saved!');      
	window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
} else{
	echo "<script>";
	echo " alert('Oops. Something went wrong. Please try again later');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
}
?>