<?php
include 'init.php';
$start=$_POST['start_date'];
$end=$_POST['end_date'];
echo $start;

$result = mysql_query("SELECT * FROM deadlines WHERE type='app form'");
$num_rows = mysql_num_rows($result);

if ($num_rows > 0) {
	$dates = "UPDATE deadlines set app_start_date='$start', app_end_date='$end' WHERE type='app form'";
}
else {
	$dates = "INSERT INTO deadlines (type,app_start_date,app_end_date) VALUES ('form','$start','$end')";
}

if(mysql_query($dates)){
	echo "<script>";
	echo " alert('Changes saved!');      
	window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
} else{
	
	echo "<script>";
	echo " alert('Oops. Something went wrong. Please try again later');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
}
?>