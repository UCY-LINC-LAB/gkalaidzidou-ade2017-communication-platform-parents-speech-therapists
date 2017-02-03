<?php
include 'init.php';

$app_num=$_GET['sender'];
$comment=$_GET['comment'];

echo $_GET['comment'];
echo $_GET['sender'];

$submitted=mysql_query ("UPDATE application set details='$comment' where app_number= '$app_num'");

if(!$submitted){
	die('Invalid query: ' . mysql_error());
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	}
	
 header('Location: ../academic_coordinator.php');	
?>