<?php
$servername = "";  //such as- localhost
$username = "";  //such as- root
$password = "";  //password for your databse
$database=""; //name of your database
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: ");
}
?>
