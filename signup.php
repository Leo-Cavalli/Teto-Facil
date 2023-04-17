<?php

    //Get data from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['senha']);


    //Connect to database
    require "conn.php";

    //Insert data into database

    $sql = "INSERT INTO `tetofacil`.`usuarios` (`nome`, `email`, `senha`) VALUES ('$name', '$email', '$password');";

    if($conn-> query($sql) === TRUE){
        echo "New record created successfully";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>