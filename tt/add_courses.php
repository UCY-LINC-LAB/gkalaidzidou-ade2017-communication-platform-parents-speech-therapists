<?php
include 'init.php';

$approved_num= $_POST['sender'];
$i=0;

foreach ($_POST["course_num"] as $num) {
	$course_number=$num;
	$grade= $_POST["grade"][$i];

	$coursesInsert = "INSERT INTO student_courses (approved_app_number, course_code, grade)
	VALUES ('$approved_num', '$course_number', '$grade') ";
	$insert = mysql_query($coursesInsert);

if (!$insert) { // add this check.

	echo "<script>";
	echo " alert('Please check again your insert.');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
}else{
	$i++;
}
}
header('Location: '. $_SERVER['HTTP_REFERER']);
?>