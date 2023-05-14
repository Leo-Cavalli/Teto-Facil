<?php

include_once '../classSession.php';

//Se o usuário estiver logado, redireciona para a homepage
if(classSession::verifySession()){
    header('Location: homepage.php');
}

//Mensagem de erro para login e cadastro, padrão vazio
$msgLogin ='';
$msgCad = '';

if(isset($_GET['msgLogin'])){
    $msgLogin = $_GET['msgLogin'];
}

if(isset($_GET['msgCad'])){
    $msgCad = $_GET['msgCad'];
}

//Mensagem alert, melhorar para outras sprints
if(isset($_GET['Alert'])){
    echo "<script>alert('".$_GET['Alert']."')</script>";
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
                            <input type="text" id="cpfCad" name="cpf" maxlength="14">
                            <label for="password">Digite sua senha: </label>
                            <input type="password" name="password" id="senhaCad" maxLenght='12'>
                            <label for="senhaConf">Confirme sua senha: </label>
                            <input input type="password" id="senhaConf" name="passwordconfirm" maxlength="12">
                        </div>
                        <button class="button-form" type="submit" name="acao" value="cadastrar" id="sendCadButton" onclick="validate()">Cadastrar</button>
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

<script>
    //Validação de cadastro
        function validate(){
        let senha = document.getElementById("senhaCad").value
        let senhaConf = document.getElementById("senhaConf").value
        let formCad = document.getElementById("formCad")
        const emailRegex = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/, "gm")
        let email = document.getElementById("emailCad").value
        const cpfRegex = new RegExp("[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}")
        let cpf = document.getElementById("cpfCad").value 

        if(senha !== senhaConf){
            alert("As senhas nao coincidem !")
            formCad.reset()
            return false

        } else if(emailRegex.test(email) !== true){
            alert("Email invalido ! \n Formato valido: xxxxx@xxxxx.xxx")
            formCad.reset()
            return false 

        } else if(cpfRegex.test(cpf) !== true){
            alert("CPF invalido ! \n Formato valido: xxx.xxx.xxx-xx")
            formCad.reset()
            return false

        } else if(cpfRegex.test(cpf) !== false && emailRegex.test(email) !== false && senha == senhaConf) { 
            formCad.submit()
            alert("Usuario cadastrado com sucesso! ")
            return true
        }

    }
</script>
