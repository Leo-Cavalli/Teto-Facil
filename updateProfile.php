<?php

include_once 'database/database.php';
include_once 'classSession.php';
include_once 'users.php';
include_once 'imovel.php';
session_start();

//Identifica a operação que o usuário deseja realizar
$op = $_POST['op'];

//Se a operação for editar nome do usuario
if($op == 'editName'){
    $newName = $_POST['newName'];
    classUsuario::editNameInBd($_SESSION['id'], $newName);
    $_SESSION['name'] = $newName;
    header('Location: frontEnd/userPage.php?Alert=Nome alterado com sucesso!');
    exit;
}

//Se a operação for editar email do usuario
if($op == 'editEmail'){
    $newEmail = $_POST['newEmail'];

    //Verifica se o email o novo email já está cadastrado no banco de dados
    $auxUser = classUsuario::getUserByEmail($newEmail);
    $auxStateAgent = classCorretor::getUserByEmail($newEmail);

    if($auxUser || $auxStateAgent instanceof classUsuario){
        header('Location: frontEnd/userPage.php?Alert=Email já cadastrado!');
        exit;
    }

    classUsuario::editEmailInBd($_SESSION['id'], $newEmail);
    $_SESSION['email'] = $newEmail;
    header('Location: frontEnd/userPage.php?Alert=Email alterado com sucesso!');
    exit;
}

//Se a operação for editar telefone do usuario
if($op == 'editTelefone'){
    $newTelefone = $_POST['newTelefone'];
    classUsuario::editTelefoneInBd($_SESSION['id'], $newTelefone);
    $_SESSION['telefone'] = $newTelefone;
    header('Location: frontEnd/userPage.php?Alert=Telefone alterado com sucesso!');
    exit;
}

//Se a operação for editar senha do usuario 
if($op == 'editPassword'){
    $newPassword = $_POST['newPassword'];

    $user = classUsuario::getUserByEmail($_SESSION['email']);

    //Verifica se a senha nova é igual a anterior
    if(password_verify($newPassword, $user->getPassword())){
        header('Location: frontEnd/userPage.php?Alert=Senha igual a anterior!');
        exit;   
    }
    
    //Se o novo email não estiver cadastrado, altera o email no banco de dados
    classUsuario::editPasswordInBd($_SESSION['id'], password_hash($newPassword, PASSWORD_DEFAULT));
    header('Location: frontEnd/userPage.php?Alert=Senha alterada com sucesso!');
    exit;
}

//Se a operação for deletar conta do usuario
if($op == 'deleteAccount'){

    //Verifica se o usuario tem imoveis cadastrados 
    if(sizeof(classImovel::getImovelByUserId($_SESSION['id'])) > 0){
        header('Location: frontEnd/userPage.php?Alert=Você não pode apagar sua conta enquanto tiver imóveis cadastrados!');
        exit;
    }
    //Deleta o usuario do banco de dados
    classUsuario::deleteUserInBd($_SESSION['id']);
    classSession::destroySession();
    header('Location: frontEnd/homepage.php');
    exit;
}

//Operações de Corretor
//Cria uma instancia de corretor, auxilia na verificação de dados
$corretor = new classCorretor();
$corretor->setUserFromDatabase($_POST['id_corretor'],$_POST['oldName'], $_POST['oldEmail'],$_POST['oldPassword'], $_POST['oldCpf'], $_POST['oldTelefone'], $_POST['oldCreci']);


//Se a operação for editar nome do corretor
if($op == 'editStateAgentName'){
   classCorretor::editNameInBd($corretor->getId(), $_POST['newName']);
    header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$_POST['newName'].'&email='.$corretor->getEmail().'&cpf='.$corretor->getCpf().'&telefone='.$corretor->getTelefone().'&creci='.$corretor->getCreci().'&password='.$corretor->getPassword().'&msg=Nome alterado com sucesso!');
    exit;
}

//Se a operação for editar email do corretor
if($op == 'editStateAgentEmail'){

    //Verifica se o email o novo email já está cadastrado no banco de dados
    $auxUser = classUsuario::getUserByEmail($_POST['newEmail']);
    $auxStateAgent = classCorretor::getUserByEmail($_POST['newEmail']);

    //Verifica as variaveis auxiliares são instancias de classUsuario, se forem é porque o email já está cadastrado
    if($auxUser || $auxStateAgent instanceof classUsuario){
        header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$corretor->getName().'&email='.$corretor->getEmail().'&cpf='.$corretor->getCpf().'&telefone='.$corretor->getTelefone().'&creci='.$corretor->getCreci().'&password='.$corretor->getPassword().'&msg=Email já cadastrado!');
        exit;
    }

    //Se o novo email não estiver cadastrado, altera o email no banco de dados
    classCorretor::editEmailInBd($corretor->getId(), $_POST['newEmail']);
    header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$corretor->getName().'&email='.$_POST['newEmail'].'&cpf='.$corretor->getCpf().'&telefone='.$corretor->getTelefone().'&creci='.$corretor->getCreci().'&password='.$corretor->getPassword().'&msg=Email alterado com sucesso!');
    exit;
}

//Se a operação for editar cpf do corretor
if($op == 'editStateAgentCpf'){
    classCorretor::editCpfInBd($corretor->getId(), $_POST['newCpf']);
    header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$corretor->getName().'&email='.$corretor->getEmail().'&cpf='.$_POST['newCpf'].'&telefone='.$corretor->getTelefone().'&creci='.$corretor->getCreci().'&password='.$corretor->getPassword().'&msg=Cpf alterado com sucesso!');
    exit;
}

//Se a operação for editar o creci do corretor
if($op == 'editStateAgentCreci'){
    classCorretor::editCreciInBd($corretor->getId(), $_POST['newCreci']);
    header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$corretor->getName().'&email='.$corretor->getEmail().'&cpf='.$corretor->getCpf().'&telefone='.$corretor->getTelefone().'&creci='.$_POST['newCreci'].'&password='.$corretor->getPassword().'&msg=Creci alterado com sucesso!');
    exit;
}

//Se a operação for editar telefone do corretor
if($op == 'editStateAgentTelefone'){
    classCorretor::editTelefoneInBd($corretor->getId(), $_POST['newTelefone']);
    header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$corretor->getName().'&email='.$corretor->getEmail().'&cpf='.$corretor->getCpf().'&telefone='.$_POST['newTelefone'].'&creci='.$corretor->getCreci().'&password='.$corretor->getPassword().'&msg=Telefone alterado com sucesso!');
    exit;
}

//Se a operação for editar senha do corretor
if($op == 'editStateAgentPassword'){
    //Cria um objeto corretor com os atributos do banco de dados
    $auxCorretor = classCorretor::getUserByEmail($corretor->getEmail());
    //Verifica se a senha nova é igual a anterior
    if(password_verify($_POST['newPassword'], $auxCorretor->getPassword())){
        header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$corretor->getName().'&email='.$corretor->getEmail().'&cpf='.$corretor->getCpf().'&telefone='.$corretor->getTelefone().'&creci='.$corretor->getCreci().'&password='.$corretor->getPassword().'&msg=Senha igual a anterior!');
        exit;
    }

    classCorretor::editPasswordInBd($corretor->getId(), password_hash($_POST['newPassword'], PASSWORD_DEFAULT));
    header('Location: frontEnd/editStateAgent.php?id='.$corretor->getId().'&name='.$corretor->getName().'&email='.$corretor->getEmail().'&cpf='.$corretor->getCpf().'&telefone='.$corretor->getTelefone().'&creci='.$corretor->getCreci().'&password='.$_POST['newPassword'].'&msg=Senha alterada com sucesso!');
    exit;
}