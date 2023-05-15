<?php
    include_once 'database/database.php';
    include_once 'classSession.php';
    include_once 'users.php';
    include_once 'imovel.php';
    session_start();

    $update_name = $_POST['update_name'];
    $update_email = $_POST['update_email'];
    $update_telefone = $_POST['update_telefone'];
    $update_senha = $_POST['update_senha'];
    $user = classUsuario::getUserByEmail($_SESSION['email']);


    //Alterar Nome caso o nome enviado  seja diferente do nome já cadastrado
    if($_SESSION['name'] != $update_name){
        classUsuario::editNameInBd($_SESSION['id'], $update_name);
        $_SESSION['name'] = $update_name;
    }

    //Alterar email caso o email enviado seja diferente do email já cadastrado
    if($_SESSION['email'] != $update_email){
        //Verifica se o email o novo email já está cadastrado no banco de dados
        $auxUser = classUsuario::getUserByEmail($update_email);
        $auxStateAgent = classCorretor::getUserByEmail($update_email);

        if($auxUser || $auxStateAgent instanceof classUsuario){
            header('Location: frontEnd/userPage.php?Alert=Email já cadastrado!');
            exit;
        }

        classUsuario::editEmailInBd($_SESSION['id'], $update_email);
        $_SESSION['email'] = $update_email;
    }

    //Alterar telefone caso o telefone enviado seja diferente do telefone já cadastrado
    if($_SESSION['telefone'] != $update_telefone){
        classUsuario::editTelefoneInBd($_SESSION['id'], $update_telefone);
        $_SESSION['telefone'] = $update_telefone;
    }

    //Alterar Senha caso a senha enviada seja diferente da senha já cadastrada
    //Verifica se a senha nova é igual a anterior
    if(!password_verify($update_senha, $user->getPassword())){
        classUsuario::editPasswordInBd($_SESSION['id'], password_hash($update_senha, PASSWORD_DEFAULT)); 
    }

    header('Location: frontEnd/userPage.php?Alert= Dados alterados com sucesso!');
    
?>