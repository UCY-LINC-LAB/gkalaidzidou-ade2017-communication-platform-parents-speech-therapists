<?php
include 'init.php';

if (ISSET($_POST['submit'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$date = $_POST['date'];
	$registryNum=$_POST['registryNum'];
	$nationality = $_POST['nationality'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$zipCode = $_POST['zipCode'];
	$phoneNum = $_POST['phoneNum'];

	$emergencyFname = $_POST['emergencyFname'];
	$emergencyLname = $_POST['emergencyLname'];
	$emergencyAddress = $_POST['emergencyAddress'];
	$emergencyCity = $_POST['emergencyCity'];
	$emergencyZipCode = $_POST['emergencyZipCode'];
	$emergencyPhoneNum = $_POST['emergencyPhoneNum'];
	$emergencyEmail = $_POST['emergencyEmail'];

	$department = $_POST['department'];
	$studyCycle= $_POST['studyCycle'];
	$yearsOfStudy = $_POST['yearsOfStudy'];
	$bachelor = $_POST['bachelor'];
	$averageGrade= $_POST['averageGrade'];
	$totalECTS =$_POST['totalECTS'];
	$degreeTime = $_POST['degreeTime'];
	$degreeForm = $_POST['degreeForm'];
	$lang1 = $_POST['lang1'];
	$lang1Level = $_POST['lang1Level'];
	$lang2 = $_POST['lang2'];
	$lang2Level = $_POST['lang2Level'];

	$llpProgramme = $_POST['llpProgramme'];
	$reason = $_POST['reason'];
	$months = $_POST['months'];
	$davinciProgramme = $_POST['davinciProgramme'];
	$monthsDavinci = $_POST['monthsDavinci'];
	$cancel = $_POST['cancel'];
	$cancelYear = $_POST['cancelYear'];
	$paragr = $_POST['paragr'];

	$movementKind = $_POST['movementKind'];
	$paragr2 = $_POST['paragr2'];

	$institution="University of Crete";

	$eml=$_SESSION['email'];
	$user_id= $_SESSION["user_ID"];

	$current=date("Y");
	$next=$current+1;
	$academic_year=$current.'-'.$next;

	$person_info = mysql_query("UPDATE person set first_name='$fname', last_name='$lname',nationality='$nationality', date_of_birth='$date',
		passport='$passport', gender='$gender', address='$address', city='$city', zip_code='$zipCode', phone='$phoneNum', registry_number='$registryNum' WHERE ID='$user_id'");

	$emergency_info =mysql_query("INSERT INTO person (ID,first_name,last_name,address,city,zip_code,country,phone,email)
		VALUES (NULL,'$emergencyFname', '$emergencyLname', '$emergencyAddress' , '$emergencyCity', '$emergencyZipCode', '$emergencyCountry', '$emergencyPhoneNum','$emergencyEmail')");

	$res =  mysql_fetch_array(mysql_query("SELECT MAX( ID ) AS emergency FROM person"),MYSQL_ASSOC);
	$emer =  $res['emergency'];

	$app_info =mysql_query("INSERT INTO application (app_number,department, study_cycle, year_of_study,bachelor, average, total_ECTS,degree_time,degree_request,
		llp_programme, llp_kind, llp_months, davinci_programme, davinci_months, cancel, cancel_reason, cancel_year, type, about_movement_reason,student_id,emergency_person_id,institution,academic_year)
	VALUES (NULL, '$department'  ,'$studyCycle','$yearsOfStudy',  '$bachelor', '$averageGrade','$totalECTS','$degreeTime','$degreeForm',
		'$llpProgramme','$reason','$months','$davinciProgramme', '$monthsDavinci', '$cancel','$paragr','$cancelYear', '$movementKind', '$paragr2','$user_id','$emer','$institution','$academic_year')");

	$res = mysql_fetch_array(mysql_query("SELECT MAX(app_number) AS A FROM application where student_id='$user_id'"),MYSQL_ASSOC);
	$app = $res['A'];

	$language_info =  mysql_query("INSERT INTO language (language,level,app_number)
		VALUES ('$lang1','$lang1Level','$app'),('$lang2','$lang2Level','$app')");

	$i=0;


$arr1 = $_POST["contents"];
$arr2 = $_POST["contents_two"];

	while (list($key, $value) = each($arr1)) {
		list($key2, $value2) = each($arr2);
		
		$country= $_POST["country"][$i] ;
		$organisation= $_POST["orgaName"][$i] ;
		$period= $_POST["periodOFstudy"][$i] ;

		$i++;
		if($organisation!=null){
			$suggested_insti = "INSERT INTO suggested_institution (app_number, institution_name, period)
			VALUES ('$app', '$organisation', '$period') ";
			$cell_result = mysql_query($suggested_insti);
		}
	
			for($j=1;$j<=6;$j++){
				if($value[$j]!=null){
					$suggested_courses = "INSERT INTO suggested_courses (app_number, institution_name, course_title,respective_course)
					VALUES ('$app', '$organisation', '$value[$j]','$value2[$j]') ";
		
					$cell_result = mysql_query($suggested_courses);
				}
		}
	}


if($_FILES['docPassport']['name'] && $_FILES['docTranscripts']['name']){

	//if no errors...
	if(!$_FILES['docPassport']['error'] && !$_FILES['docTranscripts']['error']){

		if($_FILES['docPassport']['size'] > (1024000)) {//can't be larger than 1 MB
			$valid_file = false;
			$message = 'Oops!  Your file\'s size is to large.';
		}
		else {
			$valid_file=true;
		}
		
		//if the file has passed the test
		if($valid_file){

			$currentdir = getcwd();
			$passport = '../uploads/' .$app.'_passport.'.pathinfo($_FILES['docPassport']['name'], PATHINFO_EXTENSION);
			$transcript = '../uploads/' .$app.'_transcript.'.pathinfo($_FILES['docTranscripts']['name'], PATHINFO_EXTENSION);
			$cv = '../uploads/' .$app.'_cv.'.pathinfo($_FILES['docCV']['name'], PATHINFO_EXTENSION);
			$fdegree = '../uploads/' .$app.'_fdegree.'.pathinfo($_FILES['firstDegree']['name'], PATHINFO_EXTENSION);
			$sdegree = '../uploads/' .$app.'_sdegree.'.pathinfo($_FILES['secondDegree']['name'], PATHINFO_EXTENSION);

			if(!$_FILES['docCV']['name'])
				$cv="";
			if(!$_FILES['firstDegree']['name'])
				$fdegree="";
			if(!$_FILES['secondDegree']['name'])
				$sdegree="";

			move_uploaded_file($_FILES['docPassport']['tmp_name'], $passport);
			move_uploaded_file($_FILES['docTranscripts']['tmp_name'], $transcript);
			move_uploaded_file($_FILES['docCV']['tmp_name'], $cv);
			move_uploaded_file($_FILES['firstDegree']['tmp_name'], $fdegree);
			move_uploaded_file($_FILES['secondDegree']['tmp_name'], $fdegree);

			$q = "INSERT INTO file (application_num,passport_file,transcript_file,cv_file,first_degree_file,second_degree_file)
			VALUES ('$app','$passport','$transcript','$cv','$fdegree','$sdegree')";
			mysql_query($q);
		}
	}
	//if there is an error...
	else{
		//set that to be the returned message
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['docPassport']['error'];
	}
}


if (!$person_info || !$emergency_info || !$app_info || !$language_info) { // add this check.
	die('Invalid query: ' . mysql_error());
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
} else{
	$submitted=mysql_query ("UPDATE user set submitted='1' where email= '$eml'");
	$_SESSION['submitted']='1';
		if (!$submitted) { // add this check.
			die('Invalid query: ' . mysql_error());
		}
		header('Location: ../oStudent.php');
		}
	}
 
	?>