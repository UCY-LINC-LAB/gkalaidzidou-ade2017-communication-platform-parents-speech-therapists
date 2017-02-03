<?php
$connect_error='Sorry something is going wrong! Check your connection.';

mysql_connect('localhost','root','1234') or die ($connect_error);
mysql_select_db('logoucon') or die ($connect_error);
?>