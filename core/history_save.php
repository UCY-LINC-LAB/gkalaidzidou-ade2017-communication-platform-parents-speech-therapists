<?php
include 'init.php';
session_start();

$therapist_id=$_SESSION["therapist_id"];
$patient_id = $_POST['patient_id'];

$check="SELECT * from patient_statement as p where p.patient_id='$patient_id' and p.therapist_id='$therapist_id'";
$count = mysqli_query($conn, $check);

if(!$count) {
		echo "<script>";
		echo " alert('Count problem ');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
		echo("Error description: " . mysqli_error($conn));
}

if(mysqli_num_rows($count)==0){
	if(isset($_POST['history_ftherapist'])){
		$content = $_POST['contentTherapist'];
		$add_history =  "INSERT INTO patient_statement (patient_id,therapist_id,history_ftherapist) VALUES ('$patient_id','$therapist_id','$content')";
	}else{
		$content = $_POST['contentParent'];
		$add_history =  "INSERT INTO patient_statement (patient_id,therapist_id,history_fparent) VALUES ('$patient_id','$therapist_id','$content')";
	}

	$add = mysqli_query($conn, $add_history);

	   if(! $add ) {
		echo "<script>";
		echo " alert('Please check again your insert.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
		echo("Error description: " . mysqli_error($conn));
	   }else{
	 	echo "<script>";
		echo " alert('Insert done!');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	   }
}else{
	if(isset($_POST['history_ftherapist'])){
		$content = $_POST['contentTherapist'];
		$update_history="UPDATE patient_statement set history_ftherapist='$content' where patient_id= '$patient_id' and therapist_id='$therapist_id'";


	}else{
		$content = $_POST['contentParent'];
		$update_history="UPDATE patient_statement set history_fparent='$content' where patient_id= '$patient_id' and therapist_id='$therapist_id'";
	}

	$update = mysqli_query($conn, $update_history);

	   if(! $update ) {
		echo "<script>";
		echo " alert('Please check again your update.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
		echo("Error description: " . mysqli_error($conn));
	   }else{
	 	echo "<script>";
		echo " alert('Update done!');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	   }
}
?>