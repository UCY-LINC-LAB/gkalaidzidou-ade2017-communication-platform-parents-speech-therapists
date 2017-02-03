<?php

$approved_app_num=$_SESSION['approved_app_number'];
//outgoing students info
$student_courses = mysql_query("SELECT  distinct code,title,grade,credits FROM student_courses sc, course c,approved_application ap
	where sc.approved_app_number='$approved_app_num' and sc.course_code=c.code");

	if (!$student_courses) { // add this check.
    	die('Invalid query: ' . mysql_error());
}

?>