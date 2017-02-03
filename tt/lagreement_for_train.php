<?php

$user=$_SESSION["user_ID"];
$year=$_SESSION["academic_year"];

$personal_data = mysql_fetch_array(mysql_query("SELECT * FROM person WHERE id='".$user."'"),MYSQL_ASSOC);
$personal_data2 = mysql_fetch_array(mysql_query("SELECT * FROM application WHERE academic_year='$year'and student_id='".$user."'"),MYSQL_ASSOC); //check and date of application

$approved_app= mysql_fetch_array(mysql_query("SELECT approved_app_number FROM approved_application  WHERE app_number='".$personal_data2['app_number']."'"),MYSQL_ASSOC); 

$_SESSION['approved_app_number']=$approved_app['approved_app_number'];
$_SESSION['app_number']=$personal_data2['app_number'];

$lagreement_info = mysql_fetch_array(mysql_query("SELECT * FROM learning_agreement_practice WHERE approved_app_number='".$approved_app['approved_app_number']."'"),MYSQL_ASSOC); 

$practice_details_before = mysql_fetch_array(mysql_query("SELECT * FROM practice_details WHERE phase='Before' AND lagreement_code='".$lagreement_info['code']."'"),MYSQL_ASSOC); 
$practice_details_during = mysql_fetch_array(mysql_query("SELECT * FROM practice_details WHERE phase='During' AND lagreement_code='".$lagreement_info['code']."'"),MYSQL_ASSOC); 
$practice_details_after = mysql_fetch_array(mysql_query("SELECT * FROM practice_details WHERE phase='After' AND lagreement_code='".$lagreement_info['code']."'"),MYSQL_ASSOC); 

$department = mysql_query("SELECT * FROM department");
$institution = mysql_query("SELECT  * FROM institution");

$receiv_institution=mysql_fetch_array(mysql_query("SELECT * FROM institution WHERE name='".$lagreement_info['receiving_institution']."'"),MYSQL_ASSOC); 
$send_institution=mysql_fetch_array(mysql_query("SELECT * FROM institution WHERE name='".$personal_data2['institution']."'"),MYSQL_ASSOC); 

$_SESSION['lagreement_code']=$lagreement_info['code'];

?>