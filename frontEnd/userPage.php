<?php

include_once '../classSession.php';
include_once '../users.php';
include_once '../database/database.php';


//Se o usuário desejar fazer logout
if(isset($_GET['op']) == 1){
  classSession::destroySession();
}

session_start();

//Se o usuário estiver logado, define nome e nivel de acesso(0 = Cliente, 1 = Corretor)
if(isset($_SESSION['id'])){
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
  if($level == 0){
    $user = classUsuario:: getUserByEmail($_SESSION['email']);
    $name = $user->getName();
    $cpf = $user->getCpf();
    $email = $user->getEmail();
    $telefoneValue = $user->getTelefone();
    if($telefoneValue == null){
      $telefoneValue = "Não cadastrado";
    }

  }else{
    $user = classCorretor:: getUserByEmail($_SESSION['email']);
    
    //Sim, isso mesmo
    $name = $user->getName();
    $email = $user->getEmail();
    $telefoneValue = $user->getCpf();
    $creci = $user->getTelefone();

    $database = new Database('corretor');
    $result = $database->select('cpf', 'email = '.$_SESSION['id']);
    if($result->rowCount() > 0){
      $row = $result->fetch();
      $cpf = $row['cpf'];
    }

  }
}else{
  header('Location: homepage.php');
}

//Se o telefone estiver cadastrado, seta como true;
if($telefoneValue != null){
  $telefone = true;
}else{
  $telefone = false;
}

//Mensagem Alert enviada por GET
if(isset($_GET['Alert'])){
  echo "<script>alert('".$_GET['Alert']."')</script>";
}

?>
<!DOCTYPE html5>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Stylesheets/normalize.css">
  <link rel="stylesheet" href="Stylesheets/myuser.css">
  <title>Minha Conta TF</title>
</head>

<body>
  <nav class="main-nav">
      <ul>
          <li><a href="homepage.php">Home</a></li>
          <?php
              //Se o usuário for cliente
              if($level == 0){
                  echo '<li><a href="userPage.php">Minha Conta</a></li>';
                  echo '<li><a href="meusImoveis.php">Meus Imoveis</a></li>';
                  echo '<li><a href="uploadImovel.php">Gerar Pedido de Anuncio</a></li>';
                  echo '<li><a href="homepage.php?op=1">Log Out</a></li>';
              }

              //Se o usuário for corretor
              else if($level == 1 && $_SESSION['id'] != 1){
                  echo '<li><a href="userPage.php">Minha Conta</a></li>';
                  echo '<li><a href="pedidosAnuncios.php">Pedidos de Anuncios</a></li>';
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
    <div class="col-3-5 main-content">
      <h1>Aqui estão seus dados <?=$_SESSION['name']?>.</h1>

        <div class="forms-content">
          <form action= "../updateMyUser.php" method="post" id="updateform" submit='false'>
            <label for="update_name">Nome: </label>
            <input type="textbox" name="update_name" value="<?=$name?>" <?php if($level == 1) echo 'disabled'?>></input>
            <label for="update_email">Email: </label>
            <input type="email" name="update_email" id="email" value="<?=$email?>" <?php if($level == 1) echo 'disabled'?>></input>
            <label for="cpf">CPF: </label>
            <input type="textbox" name="update_cpf" id="cpf" value="<?=$cpf?>" disabled></input>
            <label for="telefone">Telefone:</label>
            <input type="text" name='update_telefone' id='telefone' value="<?=$telefoneValue?>" <?php if($level == 1) echo 'disabled'?>>
            <?php if($level == 1){
              echo '<label for="creci">CRECI: </label>';
              echo '<input type="textbox" name="update_creci" value="'.$creci.'" disabled></input>';
            } ?>
            <label for="update_senha">Senha: </label>
            <input type="textbox" name="update_senha" placeholder="************" <?php if($level == 1) echo 'disabled'?>></input>
            <?php if ($level == 0){
              echo '<button class="button-form" type="submit" name="acao" value="logar" id="updateData" onclick = "validate()">Alterar Dados</button>';
            } ?>
          </form>

          <?php if($level == 0){
            echo '<form action="../deletarconta.php" method="post" id="formDelete">
                    <button type="submit" class="button-form" onclick="confirmar()">Deletar</button>
                  </form>';
                  
          }
          ?>
         
        </div>
    </div>

    <script>
      function validate(){
        let form = document.getElementById("updateform")

        const cpf = document.getElementById("cpf")
        const cpfRegex = new RegExp("{3}[0-9]\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}")
        
        const email = document.getElementById("email")
        const emailRegex = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/, "gm")

        const telefone = document.getElementById("telefone_user")
        const telefoneRegex = new RegExp("^(\(0[0-9]{2}\))?[0-9]{5}-[0-9]{4}$")

        if(cpfRegex.test(cpf.value) === false){
          alert("CPF Invalido! \n Formato valido: xxx.xxx.xxx-xx")
          return false
        }

        if(emailRegex.test(email.value) === false){
          alert("Email Invalido! \n Formato valido: xxxx@xxxx.xxx")
          return false
        }

        if(telefoneRegex.test(telefone.value) === false){
          alert("Telefone Invalido! \n Formato valido: (xx)xxxxx-xxxx")
          return false
        }
      }


      function confirmar(){
        let confirm = window.confirm("Tem certeza que deseja deletar a sua conta ?")
        if(confirm){
            document.getElementById("formDelete").submit()
        }else{
            event.preventDefault()
        }
    }
      

    </script>

</body>
</html>
