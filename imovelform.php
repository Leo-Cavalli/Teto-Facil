<?php

    //NÃO FAZ PARTE DA SPRINT 1


    require_once "database/database.php";
    require_once "imovel.php";
    require_once "classSession.php";

    if(!classSession::verifySession()){
        header("Location: frontEnd/loginpage.php");
        exit();
    }

    //Falta Implementar, não completo ainda;
    $id_corretor = null;
    $situacao = false;

    $imovel = new classImovel();
    $imovel->setImovel($_SESSION['id'], $id_corretor, $_POST['tipo_imovel'], $_POST['cep'], $_POST['rua'], $_POST['numero'], $_POST['bairro'], $_POST['cidade'], $_POST['estado'], $_POST['valor'], $_POST['complemento'], $_POST['descricao'], $situacao);
    $imovel->ImovelToBd();

    echo "<script>alert('Imóvel cadastrado com sucesso!');</script>";

    header("Location: frontEnd/homepage.php");

?>