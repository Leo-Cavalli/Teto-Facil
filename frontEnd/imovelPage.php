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
}

//Se o imovel estiver definido
if(!isset($_GET['id'])){
    header('location: homepage.php');
}

//Verificar se Usuario é dono do imovel
if($level == 0){
    if(classImovel::isDono($_SESSION['id'], $_GET['id'])){
        $edit = true;
    }else{
        $edit = false;
    }
}

//Verificar se Corretor é responsável pelo anuncio
if($level){
    $edit = true;
}

//Trazer Dados do Imovel
$imovel = classImovel::getImovelById($_GET['id']);

//Se o imovel não existir
if(!$imovel instanceof classImovel){
    header('location: homepage.php');
}

//Se o imovel não estiver anunciado
if($imovel->getSituacao() == false){
    $situacaoImovel = false;
}

if($imovel->getSituacao() == false){
    $situacaoImovel = "Não Anunciado";
}else{
    $situacaoImovel = "Anunciado";
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
    <title>Homepage</title>
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
        <div class="forms-content">
            <form action="">
                <Label for='imovel'>Detalhes do Imóvel</Label>
                <br>
                <label for="imagem">Imagem:</label>
                <br>
                <img src="../<?=$imovel->getDir()[0]?>" alt="imagem_imovel" height="200" width="200">
                <br>
                <label for="titulo"><?=$imovel->getTipo_imovel()?> em <?=$imovel->getCidade()?></label>
                <br>
                <label for="tipo">Tipo de Imóvel:</label>
                <input type="text" value="<?=$imovel->getTipo_imovel()?>" required>
                <br>
                <label for="estado">Estado: </label>
                <input type="text" value="<?=$imovel->getEstado()?>" required>
                <br>
                <label for="cep">Cep: </label>
                <input type="text" value="<?=$imovel->getCep()?>" required>
                <br>
                <label for="cidade">Cidade: </label>
                <input type="text" value="<?=$imovel->getCidade()?>" required>
                <br>
                <label for="bairro">Bairro: </label>
                <input type="text" value="<?=$imovel->getBairro()?>" required>
                <br>
                <label for="rua">Rua: </label>
                <input type="text" value="<?=$imovel->getRua()?>" required>
                <br>
                <label for="numero">Numero: </label>
                <input type="text" value="<?=$imovel->getNumero()?>" required>
                <br>
                <label for="complemento">Complemento: </label>
                <input type="text" value="<?=$imovel->getComplemento()?>" required>
                <br>
                <label for="valor">Valor: </label>
                <input type="text" value="<?=$imovel->getValor()?>" required>
                <br>
                <label for="descricao">Descrição: </label>
                <input type="text" value="<?=$imovel->getDescricao()?>" required>
                <br>
                <label for="situacao">Situação: </label>
                <input type="text" value="<?=$situacaoImovel?>" required>
                <br>
            </form>
            <form action="" method="post">
                <button type="submit" class="button-form">Deletar Anuncio</button>
            </form>
         
         
        </div>
    </div>

</body>
</html>