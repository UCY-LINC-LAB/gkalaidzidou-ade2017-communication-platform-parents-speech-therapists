<?php
include 'init.php';

$approved_num= $_POST['sender'];

$course=$_POST['delete'];
$coursesDelete = "DELETE FROM student_courses WHERE approved_app_number='$approved_num' and course_code='$course'";
$delete = mysql_query($coursesDelete);

if (!$delete) { // add this check.
	echo "<script>";
	echo " alert('Something is going wrong. Please try again.');      
		    window.location.href='". $_SERVER['HTTP_REFERER']."';
		</script>";
}

header('Location:'. $_SERVER['HTTP_REFERER']);
?>