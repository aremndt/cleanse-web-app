<?php
/**************************
 DO NOT EDIT THIS SECTION
 --------------------------
 POWERED BY CODEMELABS 
 **************************/
$servername = "localhost";
$username = "root";
$password = "";
$host ="recycle";

$conn = new mysqli($servername, $username, $password, $host);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>