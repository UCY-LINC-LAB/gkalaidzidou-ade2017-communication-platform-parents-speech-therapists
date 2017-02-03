<?php
include 'init.php';

$first=$_POST['fname'];
$last=$_POST['lname'];
$password =$_POST['password'];
$current=$_POST['current_password'];

$id=$_SESSION["user_ID"];
$email=$_SESSION["email"];

if(isset($_POST['changeName'])){

	$updateName = mysql_query("UPDATE person set first_name='$first', last_name='$last' where ID= '$id'");
	if(!$updateName){

		echo "<script>";
		echo " alert('Your changes could not be saved.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}
	else
	{
		$_SESSION['first_name']=$first;
		$_SESSION['last_name']=$last;
		$_SESSION['fullname']=$first." ".$last;

		echo "<script>";
		echo " alert('Your changes were saved successfully.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";

	}
}

if(isset($_POST['changePassword'])){
	$get_pass =  mysql_fetch_array(mysql_query("SELECT password from user where email='$email'"));

	if($current==$get_pass['password'])
		$updatePassowrd = mysql_query("UPDATE user set password='$password' where email='$email'");

	if(!$updatePassowrd){

		echo "<script>";
		echo " alert('Your changes could not be saved.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}
	else
	{
		$_SESSION['passowrd']=$password;

		echo "<script>";
		echo " alert('Your changes were saved successfully.');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
	}
}

?>