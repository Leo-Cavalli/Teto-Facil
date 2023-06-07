<?php

include_once 'imovel.php';

$op = $_POST['op'];
$id_imovel = $_POST['id'];
echo $id_imovel.'<br>';

if($op == 'delete'){
    classImovel::deleteImovel($id_imovel);
    echo 'Imóvel deletado com sucesso';
    header('Location: frontEnd/pedidosAnuncios.php?Alert=Imóvel deletado com sucesso');
    exit();
}

if($op == 'aprove'){
   classImovel::situacaoImovel($id_imovel, true, $_POST['stateAgentId']);
   echo 'Anuncio aprovado com sucesso';
   header('Location: frontEnd/imovelPage.php?id='.$id_imovel.'&Alert=Anuncio aprovado com sucesso');
   exit();
}

if($op == 'desaprove'){
    classImovel::situacaoImovel($id_imovel, false, null);
    echo 'Anuncio aprovado com sucesso';
    header('Location: frontEnd/imovelPage.php?id='.$id_imovel.'&Alert=Anuncio retirado com sucesso');
    exit();
}

if($op == 'update'){
    $tipo_imovel = $_POST['edit_tipo'];
    $estado = $_POST['edit_estado'];
    $cep = $_POST['edit_cep'];
    $cidade = $_POST['edit_cidade'];
    $bairro = $_POST['edit_bairro'];
    $rua = $_POST['edit_rua'];
    $numero = $_POST['edit_numero'];
    $complemento = $_POST['edit_complemento'];
    $valor = $_POST['edit_valor'];
    $descricao = $_POST['edit_descricao'];
    $tipos = array('Apartamento', 'Casa', 'Sobrado');
    $estados = array(
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapá',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceará',
        'DF' => 'Distrito Federal',
        'ES' => 'Espirito Santo',
        'GO' => 'Goiás',
        'MA' => 'Maranhão',
        'MS' => 'Mato Grosso do Sul',
        'MT' => 'Mato Grosso',
        'MG' => 'Minas Gerais',
        'PA' => 'Pará',
        'PB' => 'Paraíba',
        'PR' => 'Paraná',
        'PE' => 'Pernambuco',
        'PI' => 'Piauí',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondônia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'São Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    );
    if(!in_array($tipo_imovel, $tipos)){
        header('Location: frontEnd/imovelPage.php?id='.$id_imovel.'&Alert=Tipo de imóvel inválido\nOs tipos de imóveis válidos são: Apartamento, Casa e Sobrado');
        exit();
    }

    if(!array_key_exists($estado, $estados)){
        header('Location: frontEnd/imovelPage.php?id='.$id_imovel.'&Alert=Estado inválido\nDigite a sigla do estado');
        exit();
    }

    classImovel::updateImovel($id_imovel, $tipo_imovel, $estado, $cep, $cidade, $bairro, $rua, $numero, $complemento, $valor, $descricao);
    header('Location: frontEnd/imovelPage.php?id='.$id_imovel.'&Alert=Imóvel atualizado com sucesso');
    exit();

}