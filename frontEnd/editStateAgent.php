
<?php

include_once '../users.php';
include_once '../classSession.php';

session_start();

//Verifica se o usuário está logado como administrador, caso não esteja, redireciona para a homepage
if($_SESSION['level'] != 1 || $_SESSION['id'] != 1 && $_SESSION['level' == 1] || !isset($_SESSION['id'])){
    header('Location: homepage.php');
}

//Verifica se a Página foi acessada por um link válido
if(!isset($_GET['id'])){
    header('Location: homepage.php');
}

if(isset($_GET['id']) && $_SESSION['id'] != 1){
    header('Location: homepage.php');
}

//Exibe a mensagem do get
if(isset($_GET['Alert'])){
    echo "<script>alert('".$_GET['Alert']."')</script>";
}

if(!isset($_GET['id'])){
    header('Location: homepage.php');
}

$verifyUser = classCorretor::getUserById($_GET['id']);
if(!$verifyUser instanceof classCorretor){
    header('Location: adminPage.php');
}

//Cria um objeto corretor com os dados passados por get, deixa o codigo mais limpo
$auxUser = new classCorretor();
$auxUser->setUserFromDatabase($_GET['id'], $_GET['name'], $_GET['email'], $_GET['password'], $_GET['cpf'], $_GET['telefone'], $_GET['creci']);

$level = 1;

?>

<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/myuser.css">
    <link rel="stylesheet" href="Stylesheets/normalize.css">
    <title>Edição de corretor</title>
</head>
<body>
<nav class="main-nav">
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <?php
                //Se o usuário for cliente
                if($level == 0){
                    echo '<li><a href="userPage.php">Minha Conta</a></li>';
                    echo '<li><a href="meusImoveis.php">Meus Imoveis</a></li>';
                    echo '<li><a href="uploadImovel.php">Gerar Pedido de Anuncio</a></li>';
                    echo '<li><a href="homepage.php?op=1">Log Out</a></li>';
                }

                //Se o usuário for corretor
                else if($level == 1 && $_SESSION['id'] != 1){
                    echo '<li><a href="userPage.php">Minha Conta</a></li>';
                    echo '<li><a href="pedidosAnuncios.php">Pedidos de Anuncios</a></li>';
                    echo '<li><a href="homepage.php?op=1">Log Out</a></li>';
                }

                //Se o usuário não estiver logado
                else if(!isset($_SESSION['id'])){
                    echo '<li><a class="lasts-li" href="loginpage.php">Log In</a></li>';
                }
                //Se o usuário estiver logado como administrador
                else if($level != null && $level == 1 && $_SESSION['id'] == 1){
                    echo '<li ><a href="adminPage.php">Painel de Admin</a></li>';
                    echo '<li><a href="homepage.php?op=1">Log Out</a></li>';
                }
            ?>
        </ul>
    </nav>
    <div class="col-3-5 main-content">
        <h1>Edição de Corretor(a): <?php echo $auxUser->getName()?></h1>
        <div class="forms-content">
            <form action="../updateMyStateAgent.php" method="POST">
                <input type="hidden" name="id" value="<?=$auxUser->getId()?>">
                <label for="name">Nome: </label>
                <input type="text" name="new_name" id="new_name" value="<?=$auxUser->getName()?>">
                <label for="email">Email: </label>
                <input type="email" name="new_email" id="new_email" value="<?=$auxUser->getEmail()?>">
                <label for="cpf">CPF: </label>
                <input type="text" name="new_cpf" id="new_cpf" value="<?=$auxUser->getCpf()?>">
                <label for="creci">Creci: </label>
                <input type="text" name="new_creci" id="new_creci" value="<?=$auxUser->getCreci()?>">
                <label for="telefone">Telefone: </label>
                <input type="text" name="new_telefone" id="new_telefone" value="<?=$auxUser->getTelefone()?>">
                <label for="senha">Senha: </label>
                <input type="text" name="new_senha" id="new_password" value="********">
                <button class="button-form" type="submit" name="acao" value="atualizar" id="updateData">Alterar Dados</button>
            </form>
            <form action="../updateMyStateAgent.php" method="POST">
                <input type="hidden" name="id" value="<?=$auxUser->getId()?>">
                <input type="hidden" name="acao" value="apagar">
                <button type="submit" class="button-form">Deletar</button>
            </form>
        </div>
    </div>
</body>
</html>