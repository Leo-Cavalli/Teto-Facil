
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
        Email: <input type="email" id="nomeLogin" name="email" placeholder="Digite seu email: " maxLenght="20">
        <br>
        Senha: <input type="password" name="password" id="senhaLogin" placeholder="Digite sua senha: " maxLenght="12">
        <br>
        <button type="submit" name="acao" value="logar" id="sendLoginButton">Entrar</button>
    </form>

    <br>


    <p>Cadastro</p>
    <form action="../login.php" method="post" id="formCad">
        Nome: <input type="text" placeholder="Digite seu nome:" name="name" placeholder="Digite seu nome: " maxLenght= "20">
        <br>
        Email: <input type="email" name="email" id="emailCad" placeholder="Digite seu email: " maxLenght="30">
        <br>
        Senha: <input type="password" name="password" id="senhaCad" placeholder="Digite sua senha: ">
        <br>
        Confirme senha: <input type="password" id="senhaConf" name="passwordconfirm" placeholder="Confirme sua senha: ">
        <br>
        CPF: <input type="text" placeholder="Digite seu cpf:" id="cpfCad" name="cpfUser" >
        <button type="submit" name="acao" value="cadastrar" id="sendCadButton">cadastrar</button>
    </form>
</body>
</html>

<script>
    let senha = document.getElementById("senhaCad").value
    let senhaConf = document.getElementById("senhaConf").value
    if(senha != senhaConf){
        alert("As senhas nao estao iguais \nDigite senhas iguais !")
    }else{
        document.formaCad.submit()
    }
</script>