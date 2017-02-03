<?php
include 'init.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password1'];
$date = $_POST['date'];
$type = $_POST['type'];
$active ="No";

$add_user =  "INSERT INTO user (email,password,type,active) VALUES ('$email' , '$password', '$type','$active')";

$add_person =  "INSERT INTO person (ID,first_name,last_name,email,date_of_birth)
VALUES (NULL,'$fname', '$lname', '$email' , '$date')";

if(mysql_query($add_user) && mysql_query($add_person)){
	
	
	$res = mysql_fetch_array(mysql_query("SELECT MAX(ID) AS A FROM person where email='$email'"),MYSQL_ASSOC);
	$student_id = $res['A'];

	$add_student =  "INSERT INTO student (student_id,type) VALUES ('$student_id','$type')";

	if(mysql_query($add_student)){
		$_SESSION["add"] = "success";
	}else{
	$_SESSION["add"] = "unsuccess";
}

} else{
	$_SESSION["add"] = "unsuccess";
}
header('Location: ../e-login.php');
?>