<?php

$user=$_SESSION["user_ID"];
$department=$_SESSION["department"];

//outgoing students info
$outStudents = mysql_query("SELECT * FROM approved_application aa, application a,person p
	where aa.app_number = a.app_number and a.department='$department' and p.ID = a.student_id");

//incoming student info
$inStudents = mysql_query("SELECT * FROM approved_application aa, application a,person p
	where aa.app_number = a.app_number and a.department='$department' and p.ID = a.student_id");

//list of department courses
$dep_courses = mysql_query("SELECT * FROM department d, course c
	where d.name ='$department' AND d.code = c.department_code");
	
	if (!$outStudents || !$inStudents || !$dep_courses) { // add this check.
    	die('Invalid query: ' . mysql_error());
}
?>