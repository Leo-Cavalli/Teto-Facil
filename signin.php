<?php

    require "generalFunctions.php";

    //Get data from form
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if(searchUserIDByEmail($email) != false){

        $id = searchUserIDByEmail($email);

        $name = searchUserNameById($id);

        $passwordBd = searchUserPasswordById($id);

        if($password == $passwordBd){
            startSession($id, $name, $email);
        }else{
            echo "Senha incorreta";
        }
        
    }else{
        echo "Email não cadastrado";
    }
?>