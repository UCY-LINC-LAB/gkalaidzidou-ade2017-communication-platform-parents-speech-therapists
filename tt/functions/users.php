<?php
function user_exists($email){
	$email=sanitize($email);
	$query =mysql_query("SELECT COUNT('Email') FROM student WHERE Email ='$email'");

	return (mysql_result($query, 0)==1) ? true : false ;
}

function user_type_from_email ($email){
	$email= sanitize($email);
	return mysql_result(mysql_query("SELECT 'ID' FROM 'student' WHERE 'Email' ='$email'"), 0, 'ID');
}

function login($email,$password){

	if(isset($_POST["name"], $_POST["password"])) 
    {     

        $name = $_POST["name"]; 
        $password = $_POST["password"]; 

        $result1 = mysql_query("SELECT username, password FROM Users WHERE username = '".$name."' AND  password = '".$password."'");

        if(mysql_num_rows($result1) > 0 )
        { 
            $_SESSION["logged_in"] = true; 
            $_SESSION["naam"] = $name; 
        }
        else
        {
            echo 'The username or password are incorrect!';
        }
}
else{
	echo 'fill';
}


	
}
?>