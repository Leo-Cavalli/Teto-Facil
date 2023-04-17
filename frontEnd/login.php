<?php
    require "../conn.php";
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
    <form action="" method="post" id="formLogin">
        Login: <input type="text" id="nomeLogin">
        <br>
        Senha: <input type="password" name="senha" id="senhaLogin">
        <br>
        <input type="submit" value="Entrar" id="submitLogin" name="SubmitLogin">
    </form>

    <br>

    <!-- Implementar Confirmar Senha, mandar somente a senha confirmada para o PHP -->

    <p>Cadastro</p>
    <form action="../signup.php" method="post" id="formCad">
        Nome: <input type="text" placeholder="Digite seu nome:" name="name">
        <br>
        Email: <input type="email" name="email" id="emailCad">
        <br>
        Senha: <input type="password" name="senha" id="senhaCad">
        <br>
        <input type="submit" value="Criar conta" id="submitCad">
    </form>
</body>
</html>