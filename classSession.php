<?php

class classSession{

    //Metodo responsavel por iniciar a sessão
    //Level 0 : Usuario Comum
    //Level 1 : Corretor
    public static function setSession($id, $name, $email, $level){
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['level'] = $level;
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

    public static function verifySession(){
        session_start();
        if(isset($_SESSION['id'])){
            return true;
        }
        return false;
    }



}






?>