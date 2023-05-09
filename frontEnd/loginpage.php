<?php

include_once '../classSession.php';

if(classSession::verifySession()){
    header('Location: homepage.php');
}

$msgLogin ='';
$msgCad = '';

if(isset($_GET['msgLogin'])){
    $msgLogin = $_GET['msgLogin'];
}

if(isset($_GET['msgCad'])){
    $msgCad = $_GET['msgCad'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teto Facil</title>
</head>
<body>

    <p>Login</p>
    <form action="../login.php" method="post" id="formLogin">
        Email: <input type="email" id="nomeLogin" name="email" placeholder="Digite seu email: ">
        <br>
        Senha: <input type="password" name="password" id="senhaLogin" placeholder="Digite sua senha: ">
        <br>
        <p><?=$msgLogin?></p>
        <button type="submit" name="acao" value="logar" id="sendLoginButton">Entrar</button>
    </form>

    <br>


    <p>Cadastro</p>
    <form action="../login.php" method="post" id="formCad">
        Nome: <input type="text" placeholder="Digite seu nome:" name="name" placeholder="Digite seu nome: " maxLenght= "20">
        <br>
        Email: <input type="email" name="email" id="emailCad" placeholder="Digite seu email: " maxLenght="30">
        <br>
        CPF: <input type="text" placeholder="Digite seu cpf:" id="cpfCad" name="cpf" >
        <br>
        Senha: <input type="password" name="password" id="senhaCad" placeholder="Digite sua senha: " maxLenght='12'>
        <br>
        Confirme senha: <input type="password" id="senhaConf" name="passwordconfirm" placeholder="Confirme sua senha: " maxlength="12">
        <br>
        <p><?=$msgCad?></p>
        <button type="submit" name="acao" value="cadastrar" id="sendCadButton" >Cadastrar</button>
    </form>
</body>
</html>
