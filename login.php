<?php

require "users.php";
require "classSession.php";

if(classSession::verifySession()){
    header('Location: frontEnd/homepage.php');
    exit;
}

$acao = $_POST['acao'];


if($acao == 'cadastrar'){

    if(classUsuario::getUserByEmail($_POST['email']) instanceof classUsuario){
        echo "<script>alert('Email já cadastrado')</script>";
        header("Location: frontEnd/loginpage.php");
        exit;
    }

    $usuario = new classUsuario();
    $usuario->setUser($_POST['name'], $_POST['email'], $_POST['password']);
    $usuario->signUp();

    classSession::setSession($usuario->getId(), $_POST['name'], $_POST['email'], 0);
    header('Location: frontEnd/homepage.php');
    exit;
}

if($acao == 'logar'){

    $obusuario = classUsuario::getUserByEmail($_POST['email']);
    $obcorretor = classCorretor::getUserByEmail($_POST['email']);

    if(!$obusuario instanceof classUsuario || !password_verify($_POST['password'], $obusuario->getPassword())){
        echo "<script>alert('Email ou senha Inválidos')</script>";
        header('Location: frontEnd/loginpage.php');
        exit;
    }

    classSession::setSession($obusuario->getId(), $obusuario->getName(), $obusuario->getEmail(), 0);
    header('Location: frontEnd/homepage.php');


    if($obusuario instanceof classUsuario){
        if(!password_verify($_POST['password'], $obusuario->getPassword())){
            echo "<script>alert('Email ou senha Inválidos')</script>";
            header('Location: frontEnd/loginpage.php');
            exit;
        }
        classSession::setSession($obusuario->getId(), $obusuario->getName(), $obusuario->getEmail(), 0);
        header('Location: frontEnd/homepage.php');
    }

    if($obcorretor instanceof classCorretor){
        if(!password_verify($_POST['password'], $obcorretor->getPassword())){
            echo "<script>alert('Email ou senha Inválidos')</script>";
            header('Location: frontEnd/loginpage.php');
            exit;
        }
        classSession::setSession($obcorretor->getId(), $obcorretor->getName(), $obcorretor->getEmail(), 1);
        header('Location: frontEnd/homepage.php');
    }
}
?>