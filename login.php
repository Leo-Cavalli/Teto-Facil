<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$acao = $_POST['acao'];

require "classUsuario.php";


if($acao == 'cadastrar'){
    $usuario = new classUsuario();
    $usuario->name = $name;
    $usuario->email = $email;
    $usuario->password = $password;
    $usuario->signUp();
    session_start();
    $_SESSION['id'] = $usuario->id;
    $_SESSION['name'] = $usuario->name;
    $_SESSION['email'] = $usuario->email;
    header('Location: frontEnd/homepage.php');
    exit;
}
?>