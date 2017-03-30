<?php

include 'init.php';

if(!$_POST["data"]){
    alert("data");
    echo "Nothing Sent";
    exit;
}
 

//decode JSON data received from AJAX POST request
$data = json_decode($_POST["data"]);
 


foreach($data->positions as $item) {

     echo ("ff" + $item->top); 
    //Extract X number for panel
    $coord_X = preg_replace('/[^\d\s]/', '', $item->coordTop);
    //Extract Y number for panel
    $coord_Y = preg_replace('/[^\d\s]/', '', $item->coordLeft);

    $coord_id = preg_replace('/[^\d\s]/', '', $item->coordId);

    //escape our values - as good practice
    $x_coord = mysqli_real_escape_string($conn, $coord_X);
    $y_coord = mysqli_real_escape_string($conn, $coord_Y);
     
    //Setup our Query
    $sql = "UPDATE coords SET x_pos = '$x_coord', y_pos = '$y_coord' where id='$coord_id'";
     
    //Execute our Query
    mysqli_query($conn, $sql) or die("Error updating Coords :".mysqli_error()); 
}
 
//Return Success
//echo "success";
 
?>