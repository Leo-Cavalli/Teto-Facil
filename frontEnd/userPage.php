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
if($_SESSION['telefone'] != null){
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
            <input type="textbox" name="update_cpf" id="cpf" value="<?=$_SESSION['cpf']?>" disabled></input>
            <label for="update_email">Email: </label>
            <input type="email" name="update_email" id="email" value="<?=$_SESSION['email']?>"></input>
            <label for="update_telefone">Telefone: </label>
            <input type="telefone" name="update_telefone" id="telefone" value="<?php
              if($telefone == true){
                echo $_SESSION['telefone'];
              }
              else{
                echo "Nenhum telefone cadastrado";
              }
            ?>">
            </input>
            <label for="update_senha">Senha: </label>
            <input type="textbox" name="update_senha" placeholder="************"></input>
            <button class="button-form" type="submit" name="acao" value="logar" id="updateData" onclick = "validate()">Alterar Dados</button>
          </form>
          <form action="../deletarconta.php" method="post">
            <button type="submit" class="button-form">Deletar</button>
          </form>  
        </form>
        </div>
    </div>

    <script>
      function validate(){
        const form = document.getElementById("updateData")

        const cpf = document.getElementById("cpf")
        const cpfRegex = new RegExp("[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}")
        
        const email = document.getElementById("email")
        const emailRegex = new RegExp(/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/, "gm")

        const telefone = document.getElementById("telefone")
        const telefoneRegex = new RegExp("^(\(0[0-9]{2}\))?[0-9]{4}-[0-9]{4}$")

        if(cpfRegex.test(cpf.value) === false){
          alert("CPF Invalido! \n Formato valido: xxx.xxx.xxx-xx")
          return false
        }

        if(emailRegex.test(email.value) === false){
          alert("Email Invalido! \n Formato valido: xxxx@xxxx.xxx")
          return false
        }

        if(telefone.value != "Nenhum telefone cadastrado" ){
          if(telefoneRegex.test(telefone.value) === false){
            alert("Telefone Invalido! \n Formato valido: (0xx)xxxx-xxxx")
            return false
          }
        }
        

        form.submit()

      }
    </script>

</body>
</html>
