<?php

$institution =  mysql_query("SELECT * from institution");
$department =  mysql_query("SELECT * from department");
$courses =  mysql_query("SELECT * from course order by department_code");
$users =  mysql_query("SELECT * from user as u,person as p where u.email=p.email order by u.type");
?>