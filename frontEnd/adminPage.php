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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Stylesheets/admin_mint.css">
    <title>Página de Administrador</title>
</head>
<body>
    <header>
        <div class="logo">
            <h2>Insira sua logo</h2>
            <h3><a href="homepage.php">Home</a></h3>
        </div>
    </header>
    <h1>Página de Administrador Teto Facil</h1>
    <div class="inputArea">
        <h2 class="boxTitle">Adicionar novo Corretor ao Sistema:</h2>
        <form action="../login.php" method="post" id="formCorretor">
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

        } else if(cpfRegex.test(cpf.value) !== false && emailRegex.test(email.value) !== false && senha.value == senhaConf.value && creciRegex.test(creci.value)) { 
            formCad.submit()
            alert("Formulario enviado com sucesso !")
        }

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
                echo "<td colspan='7'>Não há corretores cadastrados</td>";
                echo "</tr>";
            }

        ?>
    </div>    

</body>
</html>