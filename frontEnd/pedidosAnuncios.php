<?php

include_once '../classSession.php';
include_once '../imovel.php';



//Se o usuário desejar fazer logout
if(isset($_GET['op']) == 1){
    classSession::destroySession();
}

session_start();

//Se o usuário estiver logado, define nome e nivel de acesso(0 = Cliente, 1 = Corretor)
if(isset($_SESSION['id'])){
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];
}else{
    header('location: homepage.php');
}

if($level != 1 || $_SESSION['id'] == 1){
    header('location: homepage.php');
}

$imoveis = classImovel::getImoveisPendentes();

if(sizeof($imoveis) == 0){
    echo '<h1>Não há pedidos de anuncios pendentes</h1>';
}

?>

<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/normalize.css">
    <link rel="stylesheet" href="Stylesheets/myuser.css">
    <title>Pedidos de Anuncio</title>
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
    <!--Se p usuário logar com conta de Corretor, Exibir CONTA DE CORRETOR, se Logar como administrador, mostra nada!-->
    <div class="col-3-5 main-content">
        <h1>Imóveis Aguardando Liberação de Anúncio</h1>
        <?php
            for($i = 0; $i < sizeof($imoveis); $i++){
                echo '<h2>Imóvel '.($i+1).'</h2>
                    <a href="imovelPage.php?id='.$imoveis[$i]->getId().'">Editar Imóvel</a>
                ';
            }
        ?>
    </div>

</body>
</html>