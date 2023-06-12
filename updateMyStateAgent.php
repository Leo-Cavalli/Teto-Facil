<?php

include_once 'users.php';

$op = $_POST['acao'];
$id = $_POST['id'];

if($op == 'apagar'){
    classCorretor::deleteStateAgent($id);
    header('Location: frontEnd/adminPage.php?Alert=Corretor apagado com sucesso!');
    exit();
}

$new_name = $_POST['new_name'];
$new_email = $_POST['new_email'];
$new_cpf = $_POST['new_cpf'];
$new_creci = $_POST['new_creci'];
$new_telefone = $_POST['new_telefone'];
$new_senha = $_POST['new_senha'];

classCorretor::editNameInBd($id, $new_name);
classCorretor::editEmailInBd($id, $new_email);
classCorretor::editCpfInBd($id, $new_cpf);
classCorretor::editCreciInBd($id, $new_creci);
classCorretor::editTelefoneInBd($id, $new_telefone);

if($new_senha != '********'){
    classCorretor::editPasswordInBd($id, password_hash($new_senha, PASSWORD_DEFAULT));
}

header('Location: frontEnd/editStateAgent.php?id='.$id.'&email='.$new_email.'&cpf='.$new_cpf.'&creci='.$new_creci.'&telefone='.$new_telefone.'&Alert=Dados alterados com sucesso!&name='.$new_name.'&password='.password_hash($new_senha, PASSWORD_DEFAULT).'');
exit();