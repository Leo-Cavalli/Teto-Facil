<?php
    include_once '../users.php';
    include_once '../imovel.php';

    session_start();
    //Verifica se o usuário está logado como administrador
    if($_SESSION['level'] != 1 || $_SESSION['id'] != 1 && $_SESSION['level'] == 1 || !isset($_SESSION['id'])){
        header('Location: homepage.php');
    }
    
    //Mensagem de Erro para Apagar Corretor
    if(isset($_GET['Alert'])){
        echo "<script>alert('".$_GET['Alert']."')</script>";
    }
    
    //Se o Administrador desejar apagar um corretor
    $op = '';
    $id_corretor = '';
    if(isset($_GET['op'])){
        $op = $_GET['op'];
        $id_corretor = $_GET['id'];
    }

    if($op == 'deleteStateAgent'){
        $ArrayImoveis = classImovel::getImovelByStateAgentID($id_corretor);

        if(sizeof($ArrayImoveis) > 0){
            header('Location: adminPage.php?Alert=Não é possivel apagar um corretor que possui imoveis cadastrados!');
            exit;
        }

        classCorretor::deleteStateAgent($id_corretor);

        header('Location: adminPage.php?Alert=Corretor apagado com sucesso!');
        exit;
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administrador</title>
</head>
<body>
    <h1>Página de Administrador Teto Facil</h1>
    <h2>Adicionar novo Corretor ao Sistema:</h2>
    <form action="../login.php" method="post">
        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" placeholder="Digite o nome do corretor: " maxlength="20" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Digite o email do corretor: " maxLenght="30" required>
        <br>
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" placeholder="Digite o cpf do corretor: " required>
        <br>
        <label for="creci">CRECI:</label>
        <input type="text" name="creci" id="creci" placeholder="Digite o creci do corretor: " required>
        <br>
        <label for="telefone">TELEFONE:</label>
        <input type="text" name="telefone" id="telefone" placeholder="Digite o telefone do corretor: " required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" placeholder="Digite a senha do corretor: " maxLenght="12" required>
        <br>
        <label for="passwordconfirm">Confirme a senha:</label>
        <input type="password" name="passwordconfirm" id="passwordconfirm" placeholder="Confirme a senha do corretor: " maxLenght="12" required>
        <br>
        <input type="hidden" name='CadStateAgent' value='CadOp'>
        <button type="submit" name="acao" value="cadastrar">Cadastrar</button>
    </form>
        <?php

            $StateAgentsArray = classCorretor::getAllStateAgentsfromBd();

            if(sizeof($StateAgentsArray) > 0){
                for($i = 0; $i < sizeof($StateAgentsArray); $i++){
                    echo "<table>";
                    echo "<li>".$StateAgentsArray[$i]->getName()."</li>";
                    echo "<li>".$StateAgentsArray[$i]->getEmail()."</li>";
                    echo "<li>".$StateAgentsArray[$i]->getCpf()."</li>";
                    echo "<li>".$StateAgentsArray[$i]->getTelefone()."</li>";
                    echo "<li>CRECI: ".$StateAgentsArray[$i]->getCreci()."</li>";
                    echo "<li>Senha: ************</li>";
                    echo "<li><a href='editStateAgent.php?id=".$StateAgentsArray[$i]->getId()."&email=".$StateAgentsArray[$i]->getEmail()."&cpf=".$StateAgentsArray[$i]->getCpf()."&telefone=".$StateAgentsArray[$i]->getTelefone()."&creci=".$StateAgentsArray[$i]->getCreci()."&password=".$StateAgentsArray[$i]->getPassword()."'>Editar</a></li>";
                    echo "<li><a href='adminPage.php?op=deleteStateAgent&id=".$StateAgentsArray[$i]->getId()."'>Apagar</a></td>";
                    echo "</li>";
                    echo "</table>";
                }
            }else{
                echo "<tr>";
                echo "<td colspan='7'>Não há corretores cadastrados</td>";
                echo "</tr>";
            }

        ?>
</body>
</html>