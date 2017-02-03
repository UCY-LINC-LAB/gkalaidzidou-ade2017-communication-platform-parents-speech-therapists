<?php
include 'init.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$date = $_POST['date'];
$nationality = $_POST['nationality'];
$passport = $_POST['passportNum'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$city = $_POST['city'];
$zipCode = $_POST['zipCode'];
$country = $_POST['country'];
$phoneNum = $_POST['phoneNum'];

$emergencyFname = $_POST['emergencyFname'];
$emergencyLname = $_POST['emergencyLname'];
$emergencyAddress = $_POST['emergencyAddress'];
$emergencyCity = $_POST['emergencyCity'];
$emergencyZipCode = $_POST['emergencyZipCode'];
$emergencyCountry = $_POST['emergencyCountry'];
$emergencyPhoneNum = $_POST['emergencyPhoneNum'];
$emergencyEmail = $_POST['emergencyEmail'];

$yearsOfStudy = $_POST['yearsOfStudy'];
$optbachelor = $_POST['optbachelor'];
$opteng = $_POST['opteng'];
$optgr = $_POST['optgr'];
$fieldOfStudy = $_POST['fieldOfStudy'];
$periodOFstudy = $_POST['periodOFstudy'];
$about_reason = $_POST['paragr'];

$homeUni = $_POST['homeUni'];
$homeDepart = $_POST['homeDepart'];

$current=date("Y");
$next=$current+1;
$academic_year=$current.'-'.$next;

$eml=$_SESSION['email'];
$user_id= $_SESSION["user_ID"];

$person_info =mysql_query("UPDATE person set first_name='$fname', last_name='$lname',nationality='$nationality', 
passport='$passport', gender='$gender', address='$address', city='$city', zip_code='$zipCode', country='$country', phone='$phoneNum'
 WHERE ID='$user_id'");

$emergency_info =mysql_query("INSERT INTO person (first_name,last_name,address,city,zip_code,country,phone,email)
VALUES ('$emergencyFname', '$emergencyLname', '$emergencyAddress' , '$emergencyCity', '$emergencyZipCode', '$emergencyCountry', '$emergencyPhoneNum','$emergencyEmail')");
$res =  mysql_fetch_array(mysql_query("SELECT MAX( ID ) AS M FROM person"),MYSQL_ASSOC);
$emer =  $res['M'];

echo $yearsOfStudy  .$optbachelor.$fieldOfStudy. $periodOFstudy. $about_reason.$homeUni.$homeDepart.$user_id.$emer.$academic_year;
$app_info =mysql_query("INSERT INTO application (app_number,year_of_study, bachelor_degree,field_of_study,period_of_study,about_movement_reason,institution,department,student_id,emergency_person_id,academic_year)
VALUES (NULL, '$yearsOfStudy'  ,'$optbachelor','$fieldOfStudy',  '$periodOFstudy', '$about_reason','$homeUni','$homeDepart','$user_id','$emer','$academic_year')");

if (!$app_info) { // add this check.
    	die('Invalid query: ' . mysql_error());}


$res = mysql_fetch_array(mysql_query("SELECT MAX(app_number) AS A FROM application where student_id='$user_id'"),MYSQL_ASSOC);
$app = $res['A'];
echo "app ".$app;

$language_info = mysql_query("INSERT INTO language (language,level,app_number)
VALUES ('English','$opteng','$app'),('Greek','$optgr','$app')");

if($_FILES['docPassport']['name'] && $_FILES['docTranscripts']['name'] && $_FILES['docLanguage']['name'] && $_FILES['docPhoto']['name']){

	//if no errors...
	if(!$_FILES['docPassport']['error'] && !$_FILES['docTranscripts']['error'] && !$_FILES['docLanguage']['error'] && !$_FILES['docPhoto']['error']){

			$currentdir = getcwd();
			$passport = '../uploads/' .$app.'_passport.'.pathinfo($_FILES['docPassport']['name'], PATHINFO_EXTENSION);
			$transcript = '../uploads/' .$app.'_transcript.'.pathinfo($_FILES['docTranscripts']['name'], PATHINFO_EXTENSION);
			$language = '../uploads/' .$app.'_language.'.pathinfo($_FILES['docLanguage']['name'], PATHINFO_EXTENSION);
			$photo = '../uploads/' .$app.'_photo.'.pathinfo($_FILES['docPhoto']['name'], PATHINFO_EXTENSION);

			move_uploaded_file($_FILES['docPassport']['tmp_name'], $passport);
			move_uploaded_file($_FILES['docTranscripts']['tmp_name'], $transcript);
			move_uploaded_file($_FILES['docLanguage']['tmp_name'], $language);
			move_uploaded_file($_FILES['docPhoto']['tmp_name'], $photo);

			$q = "INSERT INTO file (application_num,passport_file,transcript_file,language_file,photo_file)
			VALUES ('$app','$passport','$transcript','$language','$photo')";
			
			mysql_query($q);
	}
	//if there is an error...
	else{
		//set that to be the returned message
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['docPassport']['error'];
	}
}

if (!$person_info || !$emergency_info || !$app_info|| !$language_info || !$q) { // add this check.
    	die('Invalid query: ' . mysql_error());
} else{
		$submitted=mysql_query ("UPDATE user set submitted='1' where email= '$eml'");
		$_SESSION['submitted']='1';
		if (!$submitted) { // add this check.
    	die('Invalid query: ' . mysql_error());}
}
 header('Location: ../inStudent.php');
 
?>