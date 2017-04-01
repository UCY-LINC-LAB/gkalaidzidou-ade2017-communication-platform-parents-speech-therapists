<?php
include 'init.php';
session_start();

$name = $_POST['folder_title'];
$therapist_id = '1';

$today = date("Y-m-d H:i:s");


$create_folder =  "INSERT INTO folder (name,therapist_id,created_date) VALUES ('$name', '$therapist_id','$today')";

$create = mysqli_query($conn, $create_folder);
   
   if(! $create ) {
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