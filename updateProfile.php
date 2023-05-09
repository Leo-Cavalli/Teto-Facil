<?php

include_once 'database/database.php';
include_once 'classSession.php';
include_once 'users.php';
include_once 'imovel.php';
session_start();

$op = $_POST['op'];
$userbd = new database('usuarios');

if($op == 'editName'){
    $newName = $_POST['newName'];
    classUsuario::editNameInBd($_SESSION['id'], $newName);
    $_SESSION['name'] = $newName;
    header('Location: frontEnd/userPage.php?msg=Nome alterado com sucesso!');
    exit;
}

if($op == 'editEmail'){
    $newEmail = $_POST['newEmail'];
    classUsuario::editEmailInBd($_SESSION['id'], $newEmail);
    $_SESSION['email'] = $newEmail;
    header('Location: frontEnd/userPage.php?msg=Email alterado com sucesso!');
    exit;
}

if($op == 'editTelefone'){
    $newTelefone = $_POST['newTelefone'];
    classUsuario::editTelefoneInBd($_SESSION['id'], $newTelefone);
    $_SESSION['telefone'] = $newTelefone;
    header('Location: frontEnd/userPage.php?msg=Telefone alterado com sucesso!');
    exit;
}

if($op == 'editPassword'){
    $newPassword = $_POST['newPassword'];

    $user = classUsuario::getUserByEmail($_SESSION['email']);

    if(password_verify($newPassword, $user->getPassword())){
        header('Location: frontEnd/userPage.php?msg=Senha igual a anterior!');
        exit;   
    }
    
    classUsuario::editPasswordInBd($_SESSION['id'], $newPassword);
    header('Location: frontEnd/userPage.php?msg=Senha alterada com sucesso!');
    exit;
}

if($op == 'deleteAccount'){

    if(sizeof(classImovel::getImovelByUserId($_SESSION['id'])) > 0){
        header('Location: frontEnd/userPage.php?msg=Você não pode apagar sua conta enquanto tiver imóveis cadastrados!');
        exit;
    }
    classUsuario::deleteUserInBd($_SESSION['id']);
    classSession::destroySession();
    header('Location: frontEnd/homepage.php');
    exit;
}