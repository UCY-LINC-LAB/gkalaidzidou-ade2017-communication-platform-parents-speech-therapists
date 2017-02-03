<?php
include 'init.php';

$i=0;
$lagreement=$_SESSION['lagreement_code'];

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$lang_competence = $_POST['lang_competence'];
$lang = $_POST['lang'];

if(isset($_POST['transcriptAinsert'])){
	foreach ($_POST["transcriptA_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['transcriptA_check'])){

			$component_title= $_POST["transcriptA_title"][$i];
			$component_code=$_POST["transcriptA_code"][$i];
			$completed= $_POST["transcriptA_periodOFstudy"][$i];
			$credits= $_POST["transcriptA_credits"][$i];
			$grade= $_POST["transcriptA_grade"][$i];

			$institution_type='receiving';

			$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type, completed, ECTS, lagreement_code,phase,grade)
			VALUES ('$component_code', '$component_title', '$institution_type', '$completed', '$credits','$lagreement','after','$grade') ";
			$insert = mysql_query($coursesInsert);

			if (!$insert) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}//insert of receiving institution courses
else if(isset($_POST['transcriptAdelete'])){
	foreach ($_POST["transcriptA_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['transcriptA_check'])){

			$component_title= $_POST["transcriptA_title"][$i];
			$institution_type='receiving';

			$coursesDelete = "DELETE FROM study_details WHERE lagreement_code='$lagreement' and component_title='$component_title' and institution_type='$institution_type' and phase='after'";
			
			$delete = mysql_query($coursesDelete);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}

}//delete selected courses 
else if(isset($_POST['transcriptBinsert'])){
	foreach ($_POST["transcriptB_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['transcriptB_check'])){

			$component_title= $_POST["transcriptB_title"][$i];
			$component_code=$_POST["transcriptB_code"][$i];
			$credits= $_POST["transcriptB_credits"][$i];
			$grade= $_POST["transcriptB_grade"][$i];

			$institution_type='sending';

			$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type, ECTS, lagreement_code,phase,grade)
			VALUES ('$component_code', '$component_title', '$institution_type', '$credits','$lagreement','after','$grade') ";
			$insert = mysql_query($coursesInsert);

			if (!$insert) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}//insert of receiving institution courses
else if(isset($_POST['transcriptBdelete'])){
	foreach ($_POST["transcriptB_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['transcriptB_check'])){

			$component_title= $_POST["transcriptB_title"][$i];
			$institution_type='sending';

			$coursesDelete = "DELETE FROM study_details WHERE lagreement_code='$lagreement' and component_title='$component_title' and institution_type='$institution_type' and phase='after'";
			
			$delete = mysql_query($coursesDelete);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}//delete selected courses 
else if(isset($_POST['after'])){
	$after_lagreement_update ="UPDATE learning_agreement_study set start_date='$start_date',end_date='$end_date',language_competence='$lang_competence', language_level='$lang' WHERE code='$lagreement'";
	$insert=mysql_query($after_lagreement_update);

	if(!$insert){
		echo "<script>";
		echo " alert('Oops. Something went wrong. Please try again later');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
	}
}

echo "<script>";
echo " alert('Changes saved!');
location.reload();   
window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
?>


