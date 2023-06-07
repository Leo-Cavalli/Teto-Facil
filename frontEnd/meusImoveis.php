<?php

include_once '../classSession.php';
include_once '../imovel.php';
include_once '../users.php';

//Se o usuário desejar fazer logout
if(isset($_GET['op']) == 1){
    classSession::destroySession();
}

session_start();

//O nome Exibido no topo da pagina padrão (Visitante)
$name = "Visitante";

//O nivel de acesso do usuário padrão (Visitante)
$level = -1;

//Se o usuário estiver logado, define nome e nivel de acesso(0 = Cliente, 1 = Corretor)
if(isset($_SESSION['id'])){
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];
}else{
    header('Location: homepage.php');
}

//Função que monta a tabela de imoveis
$arrayImoveis = classImovel::getImovelByUserId($_SESSION['id']);
$existeImoveis = false;
if(sizeof($arrayImoveis) > 0){
    $existeImoveis = true;
}

?>

<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/normalize.css">
    <link rel="stylesheet" href="Stylesheets/home.css">
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
    <div class="col-3-5 main-content">
    
        <?php if(!$existeImoveis) echo '<h1> Você não possui imoveis cadastrados </h1>'?>

        <?php if($existeImoveis){
            for($i = 0; $i < sizeof($arrayImoveis); $i++){
                $nome_corretor = "Nenhum Corretor Associado";
                $situacao = "Não Anunciado";
                if($arrayImoveis[$i]->getSituacao()){
                    $situacao = "Anunciado";
                }
                echo '
                    <h1> Imovel '.($i+1).' </h1>
                    <br>
                    <img src="../'.$arrayImoveis[$i]->getDir()[0].'" alt="Imagem do Imovel" width="300" height="300">
                    <br>
                    <p> Valor: '.$arrayImoveis[$i]->getValor().'</p>
                    <p> Tipo de Imovel: '.$arrayImoveis[$i]->getTipo_imovel().'</p>
                    <p> CEP: '.$arrayImoveis[$i]->getCep().'</p>
                    <p> Rua: '.$arrayImoveis[$i]->getRua().'</p>
                    <p> Numero: '.$arrayImoveis[$i]->getNumero().'</p>
                    <p> Bairro: '.$arrayImoveis[$i]->getBairro().'</p>
                    <p> Cidade: '.$arrayImoveis[$i]->getCidade().'</p>
                    <p> Estado: '.$arrayImoveis[$i]->getEstado().'</p>
                    <p> Corretor: '.$nome_corretor.'</p>
                    <br>
                    <p> Complemento: '.$arrayImoveis[$i]->getComplemento().'</p>
                    <p> Descrição: '.$arrayImoveis[$i]->getDescricao().'</p>
                    <p> Situação: '.$situacao.'</p>
                    <br>
                ';
            }
        } ?>

    </div>

</body>
</html>