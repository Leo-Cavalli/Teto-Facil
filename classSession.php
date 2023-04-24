<?php

class classSession{

    public static function setSession($id, $name, $email){
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        return true;
    }

    public static function getSession(){
        session_start();
        return $_SESSION;
    }

    public static function destroySession(){
        session_start();
        session_destroy();
        header("Location: frontEnd/loginpage.php");
        exit();
    }





}






?>