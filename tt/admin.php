<?php 
include 'init.php';

if(isset($_POST['insert_insti'])){

	$insti_name=$_POST['insti_name'];
	$insti_address=$_POST['insti_address'];
	$insti_zip=$_POST['insti_zip'];
	$insti_city=$_POST['insti_city'];
	$insti_country=$_POST['insti_country'];
	$insti_lang=$_POST['insti_lang'];

	$query="INSERT INTO institution (name,address,zip_code,city,country,language) 
	VALUES ('$insti_name','$insti_address','$insti_zip','$insti_city','$insti_country','$insti_lang') ";
	$insert = mysql_query($query);
	
	if (!$insert) {
		echo "<script>";
		echo " alert('Oops. Something went wrong. Please try again later');      
		window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
	}

}else if(isset($_POST['delete_insti'])){
	$i=0;
	foreach ($_POST["n"] as $ch) {
		if($ch!=null && in_array($i,$_POST['check']) ){
			$insti_name=$_POST["n"][$i];
			
			$query="DELETE FROM institution WHERE name='$insti_name'";
			$delete = mysql_query($query);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}

		}
		$i++;
	}
}else if(isset($_POST['department_insert'])){
	$deprt_name=$_POST['depart_name'];
	$depart_code=$_POST['depart_code'];

	$query="INSERT INTO department (name,code) 
	VALUES ('$deprt_name','$depart_code') ";
	$insert = mysql_query($query);
	
	if (!$insert) {
		die('Invalid query: ' . mysql_error());
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	}
}else if(isset($_POST['department_delete'])){
	$i=0;
	foreach ($_POST["d"] as $ch) {
		if($ch!=null && in_array($i,$_POST['d_check']) ){
			$depart_code=$_POST["d"][$i];

			$query="DELETE FROM department WHERE code='$depart_code'";
			$delete = mysql_query($query);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}else if(isset($_POST['course_insert'])){
	
	$num=$_POST['num'];
	$code=$_POST['code'];
	$title=$_POST['title'];
	$department_code=$_POST['department_code'];
	$credits=$_POST['credits'];

	$query="INSERT INTO course (number,code,title,department_code,credits) 
	VALUES ('$num','$code','$title','$department_code','$credits') ";
	$insert = mysql_query($query);
	
	if (!$insert) {
		die('Invalid query: ' . mysql_error());
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	}
}else if(isset($_POST['course_delete'])){
	$i=0;
	foreach ($_POST["c"] as $ch) {
		if($ch!=null && in_array($i,$_POST['c_check']) ){
			$code=$_POST["c"][$i];

			$query="DELETE FROM course WHERE code='$code'";
			$delete = mysql_query($query);

			if (!$delete) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}else if(isset($_POST['user_insert'])){
	
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$type=$_POST['type'];
	$department=$_POST['department'];

	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
    	$n = rand(0, $alphaLength);
    	$pass[] = $alphabet[$n];
    }
    $password=implode($pass);

    $query="INSERT INTO user (email,type,password) VALUES ('$email','$type','$password') ";
    $insert = mysql_query($query);

    $add_person =  "INSERT INTO person (ID,first_name,last_name,email) VALUES (NULL,'$fname', '$lname', '$email')";
    $insert2 = mysql_query($add_person);

    if($type=='Incoming Student' || $type=='Outgoing Student'){
    	$res = mysql_fetch_array(mysql_query("SELECT MAX(ID) AS A FROM person where email='$email'"),MYSQL_ASSOC);
    	$student_id = $res['A'];
    	if($type=='Incoming Student')
    		$type="Incoming Student";
    	else{
    		$type="Outgoing Student";
    	}
    	$add_student =  "INSERT INTO student (student_id,type) VALUES ('$student_id','$type')";
    	$insert3 = mysql_query($add_student);
    }
    else{
    	$res = mysql_fetch_array(mysql_query("SELECT MAX(ID) AS A FROM person where email='$email'"),MYSQL_ASSOC);
    	$employee_id = $res['A'];

    	$add_employee =  "INSERT INTO employee (employee_id,position,department) VALUES ('$employee_id','$type','$department')";
    	$insert3 = mysql_query($add_employee);
    }
    if (!$insert || !$insert2 || !$insert3) {
    	echo "<script>";
    	echo " alert('Oops. Something went wrong. Please try again later');      
    	window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
    }
}else if(isset($_POST['user_delete'])){
	$i=0;
	foreach ($_POST["emails"] as $ch) {
		if($ch!=null && in_array($i,$_POST['u_check']) ){
			$email=$_POST["emails"][$i];
			$type=$_POST["types"][$i];

			if($type=='Incoming Student')
				$type="Incoming Student";
			else if($type=='Outgoing Student')
				$type="Outgoing Student";
			
			$person="SELECT ID FROM person where email='$email'";
			$result= mysql_fetch_array(mysql_query($person));
			$person_id=$result['ID'];

			if($type=='Incoming Student' || $type=='Outgoing Student'){
				$query="DELETE FROM student WHERE student_id='$person_id'";
				$delete = mysql_query($query);
			}
			else{
				$query="DELETE FROM employee WHERE employee_id='$person_id'";
				$delete = mysql_query($query);
			}

			$query="DELETE FROM person WHERE email='$email'";
			$delete2 = mysql_query($query);

			$query="DELETE FROM user WHERE email='$email'";
			$delete3 = mysql_query($query);

			if (!$delete || !$delete2 || !$delete3) {
				echo "<script>";
				echo " alert('Oops. Something went wrong. Please try again later');      
				window.location.href='". $_SERVER['HTTP_REFERER']."';</script>";
			}
		}
		$i++;
	}
}
echo "<script>";
echo " alert('Changes saved!');      
window.location.href='". $_SERVER['HTTP_REFERER']."'; </script>";
?>