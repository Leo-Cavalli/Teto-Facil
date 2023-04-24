
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
        Email: <input type="email" id="nomeLogin" name="email">
        <br>
        Senha: <input type="password" name="password" id="senhaLogin">
        <br>
        <button type="submit" name="acao" value="logar">Entrar</button>
    </form>

    <br>


    <p>Cadastro</p>
    <form action="../login.php" method="post" id="formCad">
        Nome: <input type="text" placeholder="Digite seu nome:" name="name">
        <br>
        Email: <input type="email" name="email" id="emailCad">
        <br>
        Senha: <input type="password" name="password" id="senhaCad">
        <br>
        Confirme senha: <input type="password" id="senhaConf">
        <br>
        <button type="submit" name="acao" value="cadastrar">cadastrar</button>
    </form>
</body>
</html>

<script>
    let senha = document.getElementById("senhaCad")
    let senhaConf = document.getElementById("senhaConf")

    if(senha != senhaConfCad){
        alert("As senhas devem ser iguais")
        senha = ''
        senhaConf = ''
    }
</script>