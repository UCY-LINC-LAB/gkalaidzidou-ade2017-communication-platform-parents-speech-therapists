<?php

include 'init.php';

if(!$_POST["data"]){
    echo "Nothing Sent";
    exit;
}
 
 $data=$_POST["data"];
//decode JSON data received from AJAX POST request
$data = json_decode($data, true);

//print_r($data);

$totalItems= count($data);

for ($x = 0; $x < $totalItems ; $x++) {
        echo $data[$x]['id'];
} 




/*
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
 */
?>