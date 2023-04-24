<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$acao = $_POST['acao'];

require "classUsuario.php";
require "classSession.php";

if($acao == 'cadastrar'){
    $usuario = new classUsuario();
    $usuario->setUser($name, $email, $password);
    $usuario->signUp();
    classSession::setSession($usuario->getId(), $name, $email);
    header('Location: frontEnd/homepage.php');
    exit;
}

if($acao == 'logar'){
    $usuario = classUsuario::getUserByEmail($email);
    if($usuario == null) {
        echo "Usuario não existe";
        exit;
    }

    if($usuario->getPassword() != md5($password)){
        echo "Senha incorreta";
        echo "<br>";
        echo "classe password". $usuario->getPassword();
        echo "<br>";
        echo "senha digitada". md5($password);
        exit;
    }

    classSession::setSession($usuario->getId(), $usuario->getName(), $email);
    header('Location: frontEnd/homepage.php');
    exit;
}







?>