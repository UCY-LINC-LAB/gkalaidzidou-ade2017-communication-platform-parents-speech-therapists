<?php
include 'init.php';


$lagreement=$_SESSION['lagreement_code'];

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$lang_competence = $_POST['lang_competence'];
$lang = $_POST['lang'];

if(isset($_POST['dates'])){
	$before_lagreement_update ="UPDATE learning_agreement_study set start_date='$start_date',end_date='$end_date',language_competence='$lang_competence', language_level='$lang' WHERE code='$lagreement'";

	if(mysql_query($before_lagreement_update)){
		echo "<script>";
		echo " alert('Changes saved!');      
		window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
	} else{
		echo "<script>";
		echo " alert('Oops. Something went wrong. Please try again later');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
	}
}

else if(isset($_POST['insert'])){
	$i=0;
	foreach ($_POST["r_title"] as $title) {
		if($title!=null && in_array($i,$_POST['r_check'])){

			$component_title_r=$_POST["r_title"][$i];
			$component_code_r=$_POST["r_code"][$i];
			$period_r= $_POST["r_periodOFstudy"][$i];
			$credits_r= $_POST["r_credits"][$i];

			$institution_type='receiving';

			$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type, semester, ECTS, lagreement_code)
			VALUES ('$component_code_r', '$component_title_r', '$institution_type', '$period_r', '$credits_r','$lagreement') ";
			$insert = mysql_query($coursesInsert);

			if (!$insert) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}else{
			$i++;

		}
	}
}//insert of receiving institution courses
else if(isset($_POST['delete'])){
	$i=0;
	foreach ($_POST["r_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['r_check'])){

			$component_title_r=$_POST["r_title"][$i];
			$component_code_r=$_POST["r_code"][$i];
			$period_r= $_POST["r_periodOFstudy"][$i];
			$credits_r= $_POST["r_credits"][$i];

			$institution_type='receiving';

			$coursesDelete = "DELETE FROM study_details WHERE lagreement_code='$lagreement' and component_title='$component_title_r' and institution_type='$institution_type'";
			
			$delete = mysql_query($coursesDelete);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}else{
			$i++;

		}
	}
}//delete selected courses 
else if(isset($_POST['insertSend'])){
	$i=0;

	foreach ($_POST["s_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['s_check'])){

			$component_title_s= $_POST["s_title"][$i];
			$component_code_s=$_POST["s_code"][$i];
			$period_s= $_POST["s_periodOFstudy"][$i];
			$credits_s= $_POST["s_credits"][$i];

			$institution_type='sending';

			$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type, semester, ECTS, lagreement_code)
			VALUES ('$component_code_s', '$component_title_s', '$institution_type', '$period_s', '$credits_s','$lagreement') ";
			$insert = mysql_query($coursesInsert);

			if (!$insert) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}else{
			$i++;

		}
	}
}//insert of receiving institution courses
else if(isset($_POST['deleteSend'])){
	$i=0;
	foreach ($_POST["s_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['s_check'])){

			$component_title_s= $_POST["s_title"][$i];
			$component_code_s=$_POST["s_code"][$i];
			$period_s= $_POST["s_periodOFstudy"][$i];
			$credits_s= $_POST["s_credits"][$i];

			$institution_type='sending';

			$coursesDelete = "DELETE FROM study_details WHERE lagreement_code='$lagreement' and component_title='$component_title_s' and institution_type='$institution_type'";
			
			$delete = mysql_query($coursesDelete);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}else{
			$i++;

		}
	}

}//delete selected courses 

echo "<script>";
echo " alert('Changes saved!');
location.reload();   
window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";

?>


