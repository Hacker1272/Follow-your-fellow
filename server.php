<?php
$servername = "fdb25.atspace.me";
$username = "3461248_kalamacademyproject";
$password = "samvidha@123";
$database="3461248_kalamacademyproject";
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {
    die("Connection failed: ");
}
?>