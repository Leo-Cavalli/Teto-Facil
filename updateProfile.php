<?php

include_once 'database/database.php';
include_once 'classSession.php';
include_once 'users.php';
include_once 'imovel.php';
session_start();

//Identifica a operação que o usuário deseja realizar
$op = $_POST['op'];
//Cria um objeto do tipo database para manipular a tabela de usuários
$userbd = new database('usuarios');

//Se a operação for editar nome do usuario
if($op == 'editName'){
    $newName = $_POST['newName'];
    classUsuario::editNameInBd($_SESSION['id'], $newName);
    $_SESSION['name'] = $newName;
    header('Location: frontEnd/userPage.php?msg=Nome alterado com sucesso!');
    exit;
}

//Se a operação for editar email do usuario
if($op == 'editEmail'){
    $newEmail = $_POST['newEmail'];
    classUsuario::editEmailInBd($_SESSION['id'], $newEmail);
    $_SESSION['email'] = $newEmail;
    header('Location: frontEnd/userPage.php?msg=Email alterado com sucesso!');
    exit;
}

//Se a operação for editar telefone do usuario
if($op == 'editTelefone'){
    $newTelefone = $_POST['newTelefone'];
    classUsuario::editTelefoneInBd($_SESSION['id'], $newTelefone);
    $_SESSION['telefone'] = $newTelefone;
    header('Location: frontEnd/userPage.php?msg=Telefone alterado com sucesso!');
    exit;
}

//Se a operação for editar senha do usuario 
if($op == 'editPassword'){
    $newPassword = $_POST['newPassword'];

    $user = classUsuario::getUserByEmail($_SESSION['email']);

    //Verifica se a senha nova é igual a anterior
    if(password_verify($newPassword, $user->getPassword())){
        header('Location: frontEnd/userPage.php?msg=Senha igual a anterior!');
        exit;   
    }
    
    classUsuario::editPasswordInBd($_SESSION['id'], $newPassword);
    header('Location: frontEnd/userPage.php?msg=Senha alterada com sucesso!');
    exit;
}

//Se a operação for deletar conta do usuario
if($op == 'deleteAccount'){


    //Verifica se o usuario tem imoveis cadastrados 
    if(sizeof(classImovel::getImovelByUserId($_SESSION['id'])) > 0){
        header('Location: frontEnd/userPage.php?msg=Você não pode apagar sua conta enquanto tiver imóveis cadastrados!');
        exit;
    }
    //Deleta o usuario do banco de dados
    classUsuario::deleteUserInBd($_SESSION['id']);
    classSession::destroySession();
    header('Location: frontEnd/homepage.php');
    exit;
}

//Operações de Corretor

