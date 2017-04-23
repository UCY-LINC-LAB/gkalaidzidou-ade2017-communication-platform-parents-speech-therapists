<?php

include 'init.php';
session_start(); 
if(!$_POST["data"]){
    echo "Nothing Sent";
    exit;
}
 
$exercise_id=$_SESSION['exercise_id'];

//decode JSON data received from AJAX POST request
$data = json_decode($_POST["data"], true);

//print_r($data);

$totalItems= count($data);

for ($x = 0; $x < $totalItems ; $x++) {
    // echo $data[$x]['id'];
    $split=explode("_", $data[$x]['id']);

    if($split[1]=="s"){
        $asset_id=$split[2];
        $prev_x=$split[3];
        $prev_y=$split[4];

        $x_pos=$data[$x]['left'];
        $y_pos=$data[$x]['top'];

        $update_ex =  "UPDATE assets_of_exercise set x_pos='$x_pos' ,y_pos='$y_pos' where exercise_id='$exercise_id' and asset_id='$asset_id' and x_pos='$prev_x' and y_pos='$prev_y'";

        $update_ex = mysqli_query($conn, $update_ex);

        if (!$update_ex)
            die('Invalid query: ' . mysqli_error($conn));

    }else{
        $asset_id=$split[1];
        $x_pos=$data[$x]['left'];
        $y_pos=$data[$x]['top'];


        $insert_exercise_assets = 
        "INSERT INTO assets_of_exercise (exercise_id,asset_id,x_pos, y_pos) VALUES ('$exercise_id','$asset_id','$x_pos', '$y_pos')";
        $insert_ex = mysqli_query($conn, $insert_exercise_assets); 

        if (!$insert_ex)
            die('Invalid query: ' . mysqli_error($conn));
        }   

        //Return Success
        echo "success";       
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
 

 */
?>