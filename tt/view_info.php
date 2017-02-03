<?php

$institution = mysql_query("SELECT distinct * FROM institution");
$academic_year=mysql_query("SELECT distinct academic_year FROM application");
$department = mysql_query("SELECT distinct name FROM department");

?>