<?php

include_once '../classSession.php';
include_once '../imovel.php';
include_once '../users.php';

//Se o usuário desejar fazer logout
if(isset($_GET['op']) == 1){
    classSession::destroySession();
}

session_start();

error_reporting(E_ERROR | E_PARSE);

//Se o usuário estiver logado, define nome e nivel de acesso(0 = Cliente, 1 = Corretor)
if(isset($_SESSION['id'])){
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];
}

//Se o imovel estiver definido
if(!isset($_GET['id'])){
    header('location: homepage.php');
}

//Dar permissão de edit para o dono do imovel e corretores
if($level == 0){
    if(classImovel::isDono($_SESSION['id'], $_GET['id'])){
        $edit = true;
    }else{
        $edit = false;
    }
}else if($level == 1 && $_SESSION['id'] != 1){
    $edit = true;
}

//Trazer Dados do Imovel
$imovel = classImovel::getImovelById($_GET['id']);

//Se o imovel não existir
if(!$imovel instanceof classImovel){
    header('location: homepage.php');
}

if($imovel->getSituacao() == false){
    $situacaoImovel = "Não Anunciado";
}else{
    $situacaoImovel = "Anunciado";
}

if(isset($_GET['Alert'])){
    echo "<script>alert('".$_GET['Alert']."')</script>";
}

$id_anunciante = classImovel::getImovelOwner($_GET['id']);

$anunciante = classUsuario::getUserById($id_anunciante);

?>

<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/normalize.css">
    <link rel="stylesheet" href="Stylesheets/imovelPage.css">
    <title>Homepage</title>
</head>
<body>
    <nav class="main-nav">
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <?php
                //Se o usuário for cliente
                if($level == 0 && isset($_SESSION['id'])){
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
    <div class="cols col-3-5 main-content">
    <h1 class="main-content-title">Detalhes do Imóvel</h1>
        <section class="apresentacao_imovel cols col-1-2">
                <img src="../<?=$imovel->getDir()[0]?>" alt="imagem_imovel" height="200" width="200">
        </section>
        <section class="conteudo_imovel cols col-1-2">
        <div class="forms-content">
            <form action="../crudImovel.php" id="formImovel" method="POST">
                <div class="row">
                    <h1 class="forms-content-title"><?=$imovel->getTipo_imovel()?> em <?=$imovel->getCidade()?></h1>
                </div>
                <div class="cols col-1-2">
                    <div class="blocks">
                <label for="tipo">Tipo de Imóvel:</label>
                <input type="text" name="edit_tipo" id = "tipo" value="<?=$imovel->getTipo_imovel()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>
                    <div class="blocks">
                <label for="estado">Estado: </label>
                <input type="text" name="edit_estado" id = "estado" value="<?=$imovel->getEstado()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>
                    <div class="blocks">
                <label for="cep">Cep: </label>
                <input type="text" name="edit_cep" id = "cep" value="<?=$imovel->getCep()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>
                    <div class="blocks">
                <label for="cidade">Cidade: </label>
                <input type="text" name="edit_cidade" value="<?=$imovel->getCidade()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>
                    <div class="blocks">
                <label for="bairro">Bairro: </label>
                <input type="text" name="edit_bairro" value="<?=$imovel->getBairro()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>    
                    <div class="blocks">
                <label for="situacao">Situação: </label>
                <input type="text" value="<?=$situacaoImovel?>" required disabled>
                    </div>
            </div>
                <div class="cols col-1-2">
                    <div class="blocks">
                <label for="rua">Rua: </label>
                <input type="text" name="edit_rua" value="<?=$imovel->getRua()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>
                    <div class="blocks">
                <label for="numero">Número: </label>
                <input type="text" name="edit_numero" value="<?=$imovel->getNumero()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>
                    <div class="blocks">
                <label for="complemento">Complemento: </label>
                <input type="text" name="edit_complemento" value="<?=$imovel->getComplemento()?>" required <?php if(!$edit) echo 'disabled'?>>
                    </div>
                    <div class="blocks">
                <label for="valor">Valor: </label>
                <input type="text" name="edit_valor" value="<?=$imovel->getValor()?>" required <?php if(!$edit) echo 'disabled'?>> 
                    </div>
                    <div class="blocks">
                <label for="descricao">Descrição: </label>
                <textarea form="formImovel" name="edit_descricao" required <?php if(!$edit) echo 'disabled'?>><?=$imovel->getDescricao()?></textarea>        
                    </div>
                <input type="hidden" name="op" value="update">
                <input type="hidden" name="id" value="<?=$imovel->getId()?>">
                    <div class="blocks">
                <label for="owner">Anunciante: <?=$anunciante->getName()?></label>
                    </div>
                <?php if($edit) echo '<button class="button-form" type="button" name="op" value="update" id="updateData" onclick = "validateForm()">Alterar Dados</button>'; ?>
                </div>
            </form>
        </div>
        </section>
        <section class="edicoes_imovel">
        <?php if($edit) echo '
                <form action="../crudImovel.php" method="post" id="formDelete">
                    <input type="hidden" name="id" value="'.$imovel->getId().'">
                    <input type="hidden" name="op" value="delete">
                    <button type="submit" class="button-form" onclick="confirmar()">Deletar Anuncio</button>
                </form>'; 
            ?>
            <?php if($edit && $level == 1 && $imovel->getSituacao() == false) echo '
                <form action="../crudImovel.php" method="post">
                    <input type="hidden" name="id" value="'.$imovel->getId().'">
                    <input type="hidden" name="op" value="aprove">
                    <input type="hidden" name="stateAgentId" value="'.$_SESSION['id'].'">
                    <button type="submit" class="button-form">Aprovar Anuncio</button>
                </form>'; 
            ?>
            <?php if($edit && $imovel->getSituacao() == true) echo '
                <form action="../crudImovel.php" method="post">
                    <input type="hidden" name="id" value="'.$imovel->getId().'">
                    <input type="hidden" name="op" value="desaprove">
                    <button type="submit" class="button-form">Retirar Anuncio</button>
                </form>'; 
            ?>
        </section>
    </div>
    <script>
        let estados = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO',];

        let tipos = ['Casa', 'Apartamento', 'Sobrado']

        function validateForm() {
            var estado = document.getElementById("estado").value.toString()
            var form = document.getElementById("formImovel")
            if (!estados.includes(estado)){
                alert("Estado Inválido")
                return false
            } 

            var tipo = document.getElementById("tipo").value
            if (!tipos.includes(tipo)){
                alert("Tipo Inválido")
                return false
            }

            var cep = document.getElementById("cep").value
            var pattern = /^\d{5}-\d{3}$/;
            if (pattern.test(cep)) {
                form.submit();
            } else {
                alert("CEP inválido. Por favor, insira um CEP válido.\nModelo válido: xxxxx-xxx");
                event.preventDefault();
            }
        }
    </script>
</body>

<script>
    function confirmar(){
        let confirm = window.confirm("Tem certeza que deseja deletar o anuncio?")
        if(confirm){
            document.getElementById("formDelete").submit()
        }else{
            event.preventDefault()
        }
    }
</script>
</html>