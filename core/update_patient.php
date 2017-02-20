<?php
include 'init.php';

$fpname = $_POST['fpname'];
$lpname = $_POST['lpname'];
$fkname = $_POST['fkname'];
$lkname = $_POST['lkname'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];

$update_patient =  "UPDATE patient set first_name='$fpname' ,last_name='$lpname' ,parent_fname='$fkname' , parent_lname='$lkname' , telephone='$telephone',email='$email' where patient_id='4'";

$update = mysqli_query($conn, $update_patient);
   
   if(! $update ) {
	echo "<script>";
	echo " alert('Please check again your update info.');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }else{
 	echo "<script>";
	echo " alert('Update done!');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }
?>