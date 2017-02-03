<?php

$result = mysql_query("SELECT * FROM deadlines where type='app form'");
$sett= mysql_fetch_array($result, MYSQL_ASSOC);

?>