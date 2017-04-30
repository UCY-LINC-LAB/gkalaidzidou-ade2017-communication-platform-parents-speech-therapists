<?php
include 'init.php';
session_start();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password1'];
$date = $_POST['date'];
$type = $_POST['type'];
$telephone =$_POST['telephone'];

if($type='Λογοθεραπευτής'){
	$type='therapist';
}else{
	$type='parent';
}

$add_user =  "INSERT INTO user (first_name,last_name,date_of_birth,telephone,email,password,type) VALUES ('$fname', '$lname','$date','$telephone','$email' , '$password', '$type')";

$add = mysqli_query($conn, $add_user);

if(!$add) {
  //die('Could not enter data: ' . mysqli_error($conn));
  $_SESSION['add'] = "unsuccess";
}else{
	if($type=='therapist'){
		$add_therapist =  "INSERT INTO speech_therapist (email) VALUES ('$email')";
		$addd = mysqli_query($conn, $add_therapist);
		if(!$add){
			  $_SESSION['add'] = "unsuccess";
			}else{
			  $_SESSION['add'] = "success";
			}
	}else{
		$_SESSION['add'] = "success";
	}
}
   
header('Location: ../login.php');
exit;
?>