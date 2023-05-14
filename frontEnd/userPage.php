<?php

include_once '../classSession.php';

//Se o usuário desejar fazer logout
if(isset($_GET['op']) == 1){
  classSession::destroySession();
}

session_start();

//Se o usuário estiver logado, define nome e nivel de acesso(0 = Cliente, 1 = Corretor)
if(isset($_SESSION['id'])){
  $name = $_SESSION['name'];
  $level = $_SESSION['level'];
}
//Seta o telefone, inicialmente como não cadastrado, telefone é inicialmente opcional para cliente comum
//Essa Variavel é utilizada para exibir a mensagem de "Nenhum telefone cadastrado" ou o telefone do usuario
$telefone = false;

//Se o telefone estiver cadastrado, seta como true;
if(isset($_SESSION['telefone'])){
  $telefone = true;
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
    <div class="col-3-5 main-content">
      <h1>Aqui estão seus dados <?=$_SESSION['name']?>.</h1>
        <div class="forms-content">
          <form action= "../updateMyUser.php" method="post" id="updateform">
          <label for="update_name">Nome: </label>
          <input type="textbox" name="update_name" value="<?=$_SESSION['name']?>"></input>
          <label for="cpf">CPF: </label>
          <input type="textbox" name="update_cpf" value="<?=$_SESSION['cpf']?>" disabled></input>
          <label for="update_email">Email: </label>
          <input type="email" name="update_email" value="<?=$_SESSION['email']?>"></input>
          <label for="update_telefone">Telefone: </label>
          <input type="telefone" name="update_telefone" value="<?php 
          if($telefone){
            echo $_SESSION['telefone'];
          }else{
            echo 'Não cadastrado';
          }
          ?>">
          </input>
          <label for="update_senha">Senha: </label>
          <input type="textbox" name="update_senha" placeholder="************"></input>
          <button class="button-form" type="submit" name="acao" value="logar" id="updateData">Alterar Dados</button>  
          <form action="../deletarconta.php" method="post">
            <button type="submit" class="button-form">Deletar</button>
          </form>  
        </form>
        </div>
    </div>

</body>
</html>
