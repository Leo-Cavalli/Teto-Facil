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

<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/normalize.css">
    <link rel="stylesheet" href="Stylesheets/login.css">
    <title>Teto Facil</title>
</head>
<body>
    <div class="spacer">
        <div class="home-button">
            <a href="homepage.php"> Home</a>
        </div>
    </div>
    <div class="row">
        <div class="cols col-2-4 forms">
            <div class="forms-title">
                <p>Login</p>
            </div>
            <div class="flexbox-forms">
                <div class="cols col-1-2">
                    <form action="../login.php" method="post" id="formLogin">
                        <div class="forms-inputs">
                            <label for="email">Email:</label>
                            <input type="email" id="nomeLogin" name="email" placeholder="Digite seu email: ">
                            <label for="password"> Senha:</label>
                            <input type="password" name="password" id="senhaLogin" placeholder="Digite sua senha: ">
                        </div>
                        <button class="button-form" type="submit" name="acao" value="logar" id="sendLoginButton">Entrar</button>
                    </form>
                </div>
                <div class="cols col-1-2">
                    <div class="logo">
                        <p> insira sua logo aqui</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="cols col-2-4 forms">
            <div class="forms-title">
                <p>Cadastro</p>
            </div>
            <div class="flexbox-forms">
                <div class="cols col-1-2">
                    <form action="../login.php" method="post" id="formCad">
                        <div class="forms-inputs">
                            <label for="name">Digite seu nome completo: </label> 
                            <input type="text" placeholder="Ex: João Pedro Santos" name="name" maxLenght="100">
                            <label for="emai">Digite seu email:</label> 
                            <input input type="email" name="email" id="emailCad" placeholder="Ex: JoãoSantos@gmail.com" maxLenght="100">
                            <label for="emai">Digite seu CPF:</label> 
                            <input type="text" id="cpfCad" name="cpf" maxlength="100">
                            <label for="password">Digite sua senha: </label>
                            <input type="password" name="password" id="senhaCad" maxLenght='12'>
                            <label for="senhaConf">Confirme sua senha: </label>
                            <input input type="password" id="senhaConf" name="passwordconfirm" maxlength="12">
                        </div>
                        <button class="button-form" type="submit" name="acao" value="cadastrar" id="sendCadButton">Cadastrar</button>
                    </form>
                </div>
                <div class="cols col-1-2">
                    <div class="logo">
                        <p> insira sua logo aqui</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
