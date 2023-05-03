<?php

$acao = $_POST['acao'];

require "classUsuario.php";
require "classSession.php";

if($acao == 'cadastrar'){

    $usuario = new classUsuario();
    $usuario->setUser($_POST['name'], $_POST['email'], $_POST['password']);
    $usuario->signUp();

    classSession::setSession($usuario->getId(), $_POST['name'], $_POST['email']);
    header('Location: frontEnd/homepage.php');
    exit;
}

if($acao == 'logar'){

    //echo $_POST['password'];

    $obusuario = classUsuario::getUserByEmail($_POST['email']);

    if(!$obusuario instanceof classUsuario){
        echo "<script>alert('Usuário não encontrado')</script>";
        exit;
    }
    
    //print_r($obusuario);

    print_r($obusuario->getPassword());

    echo "<script>alert('Logado com sucesso')</script>";




    }








?>