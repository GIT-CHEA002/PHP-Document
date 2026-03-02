<?php
$servername = "localhost";
$username  = "root";
$password = "";
$port = "3307";
$database = "db_crud_doctor";
$conn = new mysqli($servername, $username, $password, $database,$port);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

?>