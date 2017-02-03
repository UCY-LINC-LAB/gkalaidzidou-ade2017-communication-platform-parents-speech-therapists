<?php

$user=$_SESSION["user_ID"];
$year=$_SESSION["academic_year"];

$personal_data = mysql_fetch_array(mysql_query("SELECT * FROM person WHERE id='".$user."'"),MYSQL_ASSOC);
$personal_data2 = mysql_fetch_array(mysql_query("SELECT * FROM application WHERE academic_year='$year'and student_id='".$user."'"),MYSQL_ASSOC); //check and date of application

$approved_app= mysql_fetch_array(mysql_query("SELECT approved_app_number FROM approved_application  WHERE app_number='".$personal_data2['app_number']."'"),MYSQL_ASSOC); 

$_SESSION['approved_app_number']=$approved_app['approved_app_number'];
$_SESSION['app_number']=$personal_data2['app_number'];

$lagreement_info = mysql_fetch_array(mysql_query("SELECT * FROM learning_agreement_study WHERE approved_app_number='".$approved_app['approved_app_number']."'"),MYSQL_ASSOC); 

$study_details_receiving = mysql_query("SELECT * FROM study_details WHERE lagreement_code='".$lagreement_info['code']."' and institution_type='receiving' and phase='before'"); 
$study_details_sending = mysql_query("SELECT * FROM study_details WHERE lagreement_code='".$lagreement_info['code']."' and institution_type='sending'  and phase='before'"); 

$study_details_during_recev = mysql_query("SELECT * FROM study_details WHERE lagreement_code='".$lagreement_info['code']."' and institution_type='receiving'  and phase='during'"); 												
$study_details_during_send = mysql_query("SELECT * FROM study_details WHERE lagreement_code='".$lagreement_info['code']."' and institution_type='sending'  and phase='during'");

$study_details_after_recev = mysql_query("SELECT * FROM study_details WHERE lagreement_code='".$lagreement_info['code']."' and institution_type='receiving'  and phase='after'"); 												
$study_details_after_send = mysql_query("SELECT * FROM study_details WHERE lagreement_code='".$lagreement_info['code']."' and institution_type='sending'  and phase='after'"); 	

$department = mysql_query("SELECT distinct name FROM department");
$institution = mysql_query("SELECT distinct * FROM institution");

$receiv_institution=mysql_fetch_array(mysql_query("SELECT * FROM institution WHERE name='".$lagreement_info['receiving_institution']."'"),MYSQL_ASSOC); 
$send_institution=mysql_fetch_array(mysql_query("SELECT * FROM institution WHERE name='".$personal_data2['institution']."'"),MYSQL_ASSOC); 

$_SESSION['lagreement_code']=$lagreement_info['code'];

?>