<?php
include 'init.php';
session_start();

$folder_title = $_POST['newFolder_title'];
$folder_id=$_POST['folder_id'];
$exer_title = $_POST['exer_title'];
$therapist_id=$_SESSION["therapist_id"];  

$today = date("Y-m-d H:i:s");

if($folder_title!=null){
	$create_folder =  "INSERT INTO folder (name,therapist_id,created_date) VALUES ('$folder_title', '$therapist_id','$today')";
	$create = mysqli_query($conn, $create_folder);

	if($create){
		$get_folder_id= mysqli_query($conn,"SELECT folder_id FROM folder ORDER BY folder_id DESC LIMIT 1");
		if(mysqli_num_rows($get_folder_id) > 0 ){   
    		$result =  mysqli_fetch_array($get_folder_id, MYSQLI_ASSOC);
    		$folder_id=$result['folder_id'];
		}
	}
}

$_SESSION["folder_id"]=$folder_id;

$insert_exercise = "INSERT INTO exercise (folder_id,therapist_id,created_date, ex_name) VALUES ('$folder_id','$therapist_id','$today', '$exer_title')";
$insert_ex = mysqli_query($conn, $insert_exercise);
   
if(! $insert_ex ) {
	echo "<script>";
	echo " alert('Please check again your insert.');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
}else{
	$get_exercise_id= mysqli_query($conn,"SELECT exercise_id FROM exercise ORDER BY exercise_id DESC LIMIT 1");
		if(mysqli_num_rows($get_exercise_id) > 0 ){   
    		$result =  mysqli_fetch_array($get_exercise_id, MYSQLI_ASSOC);
    		$_SESSION["exercise_id"]=$result['exercise_id'];
		}

 	echo "<script>";
	echo " alert('Insert done!');      
	window.location.href='". $_SERVER['HTTP_REFERER']."';
	</script>";
   }
?>