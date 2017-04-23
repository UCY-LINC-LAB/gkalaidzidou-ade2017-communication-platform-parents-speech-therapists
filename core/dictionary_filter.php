<?php
include 'init.php';
session_start();

$word = $_POST['word'];
$filter = $_POST['filter'];

if($word=="")
	$search=mysqli_query($conn,"SELECT word FROM dictionary");
else if($filter=="start")
	$search=mysqli_query($conn,"SELECT word FROM dictionary WHERE word LIKE '".$word."%'");
else if($filter=="ends")
	$search=mysqli_query($conn,"SELECT word FROM dictionary WHERE word LIKE '%".$word."' ");
else if($filter=="contains")
	$search=mysqli_query($conn,"SELECT word FROM dictionary WHERE word LIKE '%".$word."%' ");
else
	$search=mysqli_query($conn,"SELECT word FROM dictionary WHERE word LIKE '".$word."%' or word LIKE '%".$word."' or word LIKE '%".$word."%' ");

if (!$search) {
	echo "Something going wrong";
	//die('Invalid query: ' . mysqli_error($conn));
}else{
	 while ($words = mysqli_fetch_array($search)) {
	 	echo "".$words['word']."<br>";
	 }
}
?>