<?php

include_once "imovel.php";
include_once "database/database.php";

session_start();

$database = new Database('imoveisdefinitivos');

$id_imovel = $database->insert([
    "id_anunciante" => $_SESSION['id'],
    "id_corretor" => null,
    "tipo_imovel" => $_POST['tipo_imovel'],
    "cep" => $_POST['cep'],
    "rua" => $_POST['rua'],
    "numero" => $_POST['numero'],
    "bairro" => $_POST['bairro'],
    "cidade" => $_POST['cidade'],
    "estado" => $_POST['estado'],
    "valor" => $_POST['valor'],
    "complemento" => $_POST['complemento'],
    "descricao" => $_POST['descricao'],
    "situacao" => false
]);

$foto = $_FILES['foto']['tmp_name'];
$pasta = 'fotos';

$file = getimagesize($foto);

if(!preg_match('/^image\/(?:gif|jpg|jpeg|png)$/i', $file['mime'])){
    header("Location: frontEnd/uploadImovel.php?Alert=Formato de imagem inválido");
    exit();
}

$extensao = str_ireplace("/", "", strchr($file['mime'], "/"));

$novoDestino = "{$pasta}/foto_arquivo_".uniqid('', true) . '.' . $extensao;  

move_uploaded_file ($foto , $novoDestino );

$database = new Database('imagens');

$database->insert([
    "id_imovel" => $id_imovel,
    "dir" => $novoDestino
]);

header('Location: frontEnd/uploadImovel.php?Alert=Imóvel cadastrado com sucesso');