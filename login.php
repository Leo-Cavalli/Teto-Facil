<?php

require_once "users.php";
require_once "classSession.php";

//Ação a ser realizada
$acao = $_POST['acao'];

//Se a ação for cadastrar um corretor, $CadStateAgent = true, se não, $CadStateAgent = false
$CadStateAgent = false;
if(isset($_POST['CadStateAgent'])){
    $CadStateAgent = true;
}

//Verifica se o usuario ja esta logado, caso esteja, redireciona para a homepage.php, não funciona no caso de cadastro de corretor
if(classSession::verifySession() && !$CadStateAgent){
    header('Location: frontEnd/homepage.php');
    exit;
 }

//Se a ação for cadastrar
if($acao == 'cadastrar'){

    //Verifica se o email ja esta cadastrado para algum usuario
    if(classUsuario::getUserByEmail($_POST['email']) instanceof classUsuario){

        //Se o cadastro for de um corretor, redireciona para a pagina de cadastro de corretor
        if($CadStateAgent){
            header("Location: frontEnd/adminPage.php?Alert=Email já cadastrado");
            exit;
        }

        header("Location: frontEnd/loginpage.php?Alert=Email já cadastrado");
        exit;
    }

    //Verifica se o email ja esta cadastrado para algum corretor
    if(classCorretor::getUserByEmail($_POST['email']) instanceof classCorretor){
        
        //Se o cadastro for de um corretor, redireciona para a pagina de cadastro de corretor
        if($CadStateAgent){
            header("Location: frontEnd/adminPage.php?Alert=Email já cadastrado");
            exit;
        }

        header("Location: frontEnd/loginpage.php?Alert=Email já cadastrado");
        exit;
    }

    //Verifica se as senhas são iguais
    if($_POST['password'] != $_POST['passwordconfirm']){
        
        //Se o cadastro for de um corretor, redireciona para a pagina de cadastro de corretor
        if($CadStateAgent){
            header("Location: frontEnd/adminPage.php?Alert=As senhas não estão iguais");
            exit;
        }
        header("Location: frontEnd/loginpage.php?Alert=As senhas não estão iguais");
        exit;
    }

    //Cadastro de corretor
    if($CadStateAgent){
        $stateAgent = new classCorretor();

        $stateAgent->setUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['cpf'], $_POST['telefone'], $_POST['creci']);

        $stateAgent->signUp();

        header('Location: frontEnd/adminPage.php?Alert=Corretor cadastrado com sucesso');
        exit;
    }

    //Cria um objeto usuario
    $usuario = new classUsuario();

    //Seta os valores do objeto usuario
    $usuario->setUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['cpf']);

    //Cadastra o usuario no banco de dados
    $usuario->signUp();

    //Inicia a sessão, redireciona para a homepage.php e encerra o script
    classSession::setSession($usuario->getId(), $_POST['name'], $_POST['email'], 0, $_POST['cpf']);
    header('Location: frontEnd/homepage.php');
    exit;
}

//Se a ação for logar
if($acao == 'logar'){

    //Verifica se o email esta cadastrado para algum usuario, retorna um objeto usuario ou falso
    $obusuario = classUsuario::getUserByEmail($_POST['email']);
    $obcorretor = classCorretor::getUserByEmail($_POST['email']);

    //Verifica se o email esta cadastrado para algum corretor
    if($obusuario instanceof classUsuario){
        //Verifica se a senha esta correta
        if(!password_verify($_POST['password'], $obusuario->getPassword())){
            echo "<script>alert('Email ou senha Inválidos')</script>";
            header('Location: frontEnd/loginpage.php?Alert=Email ou senha Inválidos');
            exit;
        }
        //Inicia a sessão, redireciona para a homepage.php e encerra o script
        classSession::setSession($obusuario->getId(), $obusuario->getName(), $obusuario->getEmail(), 0, $obusuario->getCpf(). $obusuario->getTelefone());
        header('Location: frontEnd/homepage.php');
        exit;
    }

    //Verifica se o email esta cadastrado para algum corretor
    if($obcorretor instanceof classCorretor){
        //Verifica se a senha esta correta
        if(!password_verify($_POST['password'], $obcorretor->getPassword())){
            echo "<script>alert('Email ou senha Inválidos')</script>";
            header('Location: frontEnd/loginpage.php?Alert=Email ou senha Inválidos');
            exit;
        }
        //Inicia a sessão, redireciona para a homepage.php e encerra o script
        classSession::setSession($obcorretor->getId(), $obcorretor->getName(), $obcorretor->getEmail(), 1, $obcorretor->getCpf(), $obcorretor->getTelefone());
        header('Location: frontEnd/homepage.php');
        exit;
    }

    //Se não encontrar o usuario ou corretor, redireciona para a loginpage.php
    echo "<script>alert('Email ou senha Inválidos')</script>";
    header('Location: frontEnd/loginpage.php?Alert=Email ou senha Inválidos');
    exit;
}
?>