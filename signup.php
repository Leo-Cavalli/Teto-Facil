<?php
    //Get data from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //Connect to database
    require "generalFunctions.php";

    //Call function to insert new user
    signUpUser($name, $email, $password);
?>