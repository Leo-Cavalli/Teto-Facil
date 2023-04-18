<?php

//Change if Necessary
$servernameBD = "localhost";
$usernameBD = 'root';
$passwordBD = '';

// Create connection
$conn = new mysqli($servernameBD, $usernameBD, $passwordBD);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

?>
