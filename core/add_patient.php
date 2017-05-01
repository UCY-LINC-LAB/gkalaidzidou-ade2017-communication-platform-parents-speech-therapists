<?php
include 'init.php';
session_start();

$fpname = $_POST['fpname'];
$lpname = $_POST['lpname'];
$fkname = $_POST['fkname'];
$lkname = $_POST['lkname'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$therapist_id=$_SESSION["therapist_id"];

$today = date("Y-m-d H:i:s");

$add_patient =  "INSERT INTO patient (therapist_id, first_name,last_name,parent_fname, parent_lname, telephone,email,registration_date) VALUES ('$therapist_id','$fpname', '$lpname','$fkname', '$lkname','$telephone','$email','$today')";

$add = mysqli_query($conn, $add_patient);
   
   if(! $add ) {
	echo "<script>";
	echo " alert('Please check again your insert.');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }else{
 	echo "<script>";
	echo " alert('Insert done!');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }
?>