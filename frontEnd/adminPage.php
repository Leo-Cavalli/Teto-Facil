<?php
    include_once '../users.php';
    include_once '../imovel.php';
    include_once '../classSession.php';

    session_start();
    //Verifica se o usuário está logado como administrador

    //Se o usuário estiver logado, define nome e nivel de acesso(0 = Cliente, 1 = Corretor)
    if(isset($_SESSION['id'])){
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];
    }
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

    //Se o Administrador desejar apagar um corretor, mover para "updateProfile" quando possivel;
    if($op == 'deleteStateAgent'){
        $ArrayImoveis = classImovel::getImovelByStateAgentID($id_corretor);

        //Verifica se o corretor possui imoveis cadastrados
        if(sizeof($ArrayImoveis) > 0){
            header('Location: adminPage.php?Alert=Não é possivel apagar um corretor que possui imoveis cadastrados!');
            exit;
        }

        //Deleta o corretor do banco de dados, direciona a pagina para adminPage.php
        classCorretor::deleteStateAgent($id_corretor);
        header('Location: adminPage.php?Alert=Corretor apagado com sucesso!');
        exit;
    }

 ?>
<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/normalize.css">
    <link rel="stylesheet" href="Stylesheets/admin_mint.css">
    <title>Página de Administrador</title>
</head>
<body>
    <nav class="main-nav">
    <ul>
          <li><a href="homepage.php">Home</a></li>
          <?php
              //Se o usuário for um corretor ou um cliente
              if($level == 0 || $level == 1 && $_SESSION['id'] != 1){
                  echo '<li><a href="userPage.php">Minha Conta</a></li>';
                  echo '<li><a href="homepage.php?op=1">Log Out</a></li>';
              }
              //Se o usuário não estiver logado
              else if(!isset($_SESSION['id'])){
                  echo '<li><a class="lasts-li" href="loginpage.php">Log In</a></li>';
              }
              //Se o usuário estiver logado como administrador
              else if($level != null && $level == 1 && $_SESSION['id'] == 1){
                  echo '<li ><a href="adminPage.php">Painel de Admin</a></li>';
                  echo '<li><a href="homepage.php?op=1">Log Out</a></li>';
              }
          ?>
      </ul>
  </nav>
    <h1 class="pagetitle">Página de Administrador Teto Facil</h1>
    <div class="inputArea">
        <h2>Adicionar novo Corretor ao Sistema:</h2>
        <form class="forms" action="../login.php" method="post" id="formCorretor">
            <label for="name">Nome:</label>
            <input class="textarea" type="text" name="name" id="name" placeholder="Digite o nome do corretor: " maxlength="20" required>
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
            <button class="button-form" type="submit" name="acao" value="cadastrar" onclick = "validate()">Cadastrar</button>
        </form>
    </div>

    <script>
        //validacao dos campos do corretor
        function validate(){
        let senha = document.getElementById("password")
        let senhaConf = document.getElementById("passwordconfirm")
        let formCad = document.getElementById("formCorretor")

        const emailRegex = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/, "gm")
        let email = document.getElementById("email")

        const cpfRegex = new RegExp("[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}")
        let cpf = document.getElementById("cpf")

        const creci = document.getElementById("creci")
        const creciRegex = new RegExp("^[0-9]{2}[.]?[0-9]{4}[.]?[0-9]{1,2}$")

        if(senha.value !== senhaConf.value){
            alert("As senhas nao coincidem !")
            formCad.reset()
            return false 

        } else if(emailRegex.test(email.value) !== true){
            alert("Email invalido ! \n Formato valido: xxxxx@xxxxx.xxx")
            formCad.reset()
            return false 

        } else if(cpfRegex.test(cpf.value) !== true){
            alert("CPF invalido ! \n Formato valido: xxx.xxx.xxx-xx")
            formCad.reset()
            return false 

        } else if(creciRegex.test(creci.value) !== true){
                alert("CRECI invalido ! \n Formato valido: 00.0000.0 ou 00.0000.00")
                formCad.reset()
                return false
        }

        formCad.submit()

    }

    </script>

    <div class="infoAdmin">
        <h1>Lista de Corretores</h1>
        <?php

            $StateAgentsArray = classCorretor::getAllStateAgentsfromBd();

            if(sizeof($StateAgentsArray) > 0){
                for($i = 0; $i < sizeof($StateAgentsArray); $i++){
                    echo "<div class = divAdmin>";
                    echo "<h2>Corretor ".$StateAgentsArray[$i]->getName(). "</h2>";
                    echo "<li>Nome: ".$StateAgentsArray[$i]->getName()."</li>";
                    echo "<li>Email: ".$StateAgentsArray[$i]->getEmail()."</li>";
                    echo "<li>CPF: ".$StateAgentsArray[$i]->getCpf()."</li>";
                    echo "<li>Telefone: ".$StateAgentsArray[$i]->getTelefone()."</li>";
                    echo "<li>CRECI: ".$StateAgentsArray[$i]->getCreci()."</li>";
                    echo "<li>Senha: ************</li>";
                    echo "<li ><a href='editStateAgent.php?id=".$StateAgentsArray[$i]->getId()."&email=".$StateAgentsArray[$i]->getEmail()."&cpf=".$StateAgentsArray[$i]->getCpf()."&telefone=".$StateAgentsArray[$i]->getTelefone()."&creci=".$StateAgentsArray[$i]->getCreci()."&password=".$StateAgentsArray[$i]->getPassword()."&name=".$StateAgentsArray[$i]->getName()."'>Editar</a></li>";
                    echo "<li><a href='adminPage.php?op=deleteStateAgent&id=".$StateAgentsArray[$i]->getId()."'>Apagar</a></td>";
                    echo "</li>";
                    echo "<br>";
                    echo "</div>";
                }
            }else{
                echo "<tr>";
                echo "<td colspan='7'><h2 style= text-align:center ,>Não há corretores cadastrados</h2></td>";
                echo "</tr>";
            }

        ?>
    </div>    

</body>
</html>