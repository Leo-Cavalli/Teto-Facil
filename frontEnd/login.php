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
    <form action="" method="post" id="formLogin">
        Login: <input type="text" id="nomeLogin" placeholder = "Digite seu login: ">
        <br>
        SSenha: <input type="password" name="senha" id="senhaLogin">
        <br>
        <input type="submit" value="Entrar" id="submitLogin" name="SubmitLogin">
    </form>
    <form action="" method="post" id="formCad">
        Nome: <input type="text" placeholder="Digite seu nome:">
        <br>
        Email: <input type="email" name="email" id="emailCad" placeholder="Digite seu email:">
        <br>
        Senha: <input type="password" name="senha" id="senhaCad" placeholder="Digite sua senha:">
        <br>
        Confirme a senha:  <input type="password" name="senhaConf" id="senhaConfCad" placeholder="Confirme sua senha:">
        <input type="submit" value="Criar conta" id="submitCad">
    </form>
</body>
</html>