<?php

include_once 'users.php';

$op = $_POST['acao'];
$id = $_POST['id'];

echo $op;
echo $id;


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


if(classCorretor::verifyIfEmailAlreadExists($id, $new_email)){
    header('Location: frontEnd/editStateAgent.php?id='.$id.'&Alert=Email já cadastrado!&name='.$new_name.'&cpf='.$new_cpf.'&creci='.$new_creci.'&telefone='.$new_telefone.'&password='.password_hash($new_senha, PASSWORD_DEFAULT).'&email='.$new_email.'');
    exit();
}

if(classCorretor::verifyIfCpfAlreadExists($id, $new_cpf)){
    header('Location: frontEnd/editStateAgent.php?id='.$id.'&Alert=CPF já cadastrado!&name='.$new_name.'&email='.$new_email.'&creci='.$new_creci.'&telefone='.$new_telefone.'&password='.password_hash($new_senha, PASSWORD_DEFAULT).'&cpf='.$new_cpf.'');
    exit();
}

if(classCorretor::verifyIfCreciAlreadExists($id, $new_creci)){
    header('Location: frontEnd/editStateAgent.php?id='.$id.'&Alert=CRECI já cadastrado!&name='.$new_name.'&email='.$new_email.'&cpf='.$new_cpf.'&telefone='.$new_telefone.'&password='.password_hash($new_senha, PASSWORD_DEFAULT).'&creci='.$new_creci.'');
    exit();
}

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
