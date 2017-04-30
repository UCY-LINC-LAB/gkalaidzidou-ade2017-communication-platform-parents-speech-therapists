<?php
session_start();
error_reporting(0);

$conn=mysqli_connect("localhost","root","1234","logouconn");
mysqli_set_charset($conn, "utf8");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>