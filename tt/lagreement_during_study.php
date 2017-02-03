<?php
include 'init.php';

$i=0;
$lagreement=$_SESSION['lagreement_code'];

if(isset($_POST['insert_tableA'])){
	foreach ($_POST["A_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['select'])){

			$component_title= $_POST["A_title"][$i];
			$component_code=$_POST["A_code"][$i];
			$reason= $_POST["A_reason"][$i];
			$credits= $_POST["A_credits"][$i];

			$institution_type='receiving';

			if(in_array($i,$_POST['A_check_add'])){
				$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type,reason, ECTS, lagreement_code,phase,added_component,deleted_component)
				VALUES ('$component_code', '$component_title', '$institution_type','$reason', '$credits','$lagreement','during','true','false') ";
				$insert = mysql_query($coursesInsert);
			}
			else{
				$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type,reason, ECTS, lagreement_code,phase,added_component,deleted_component)
				VALUES ('$component_code', '$component_title', '$institution_type','$reason', '$credits','$lagreement','during','false','true') ";
				$insert = mysql_query($coursesInsert);
			}
			if (!$insert) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}// insert table A
else if(isset($_POST['delete_tableA'])){

	foreach ($_POST["A_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['select'])){

			$component_title= $_POST["A_title"][$i];

			$coursesDelete = "DELETE FROM study_details where  lagreement_code='$lagreement' and phase='during' and institution_type='receiving' and component_title='$component_title'";

			$delete = mysql_query($coursesDelete);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}// insert table A
else if(isset($_POST['insert_tableB'])){
	foreach ($_POST["B_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['select_B'])){

			$component_title= $_POST["B_title"][$i];
			$component_code=$_POST["B_code"][$i];
			$credits= $_POST["B_credits"][$i];

			$institution_type='sending';

			if(in_array($i,$_POST['B_check_add'])){

				$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type,reason, ECTS, lagreement_code,phase,added_component,deleted_component)
				VALUES ('$component_code', '$component_title', '$institution_type','$reason', '$credits','$lagreement','during','true','false') ";
				$insert = mysql_query($coursesInsert);	
			}
			else{
				$coursesInsert = "INSERT INTO study_details (component_code, component_title, institution_type,reason, ECTS, lagreement_code,phase,added_component,deleted_component)
				VALUES ('$component_code', '$component_title', '$institution_type','$reason', '$credits','$lagreement','during','false','true') ";
				
				$insert = mysql_query($coursesInsert);	
			}
			if (!$insert) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}// save table B
else if(isset($_POST['delete_tableB'])){

	foreach ($_POST["B_title"] as $title) {
		if($title!=null  && in_array($i,$_POST['select_B'])){

			$component_title= $_POST["B_title"][$i];

			$coursesDelete = "DELETE FROM study_details where  lagreement_code='$lagreement' and phase='during' and institution_type='sending' and component_title='$component_title'";

			$delete = mysql_query($coursesDelete);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}

echo "<script>";
echo " alert('Changes saved!');
location.reload();   
	window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
	
?>


