<?php
  session_start();
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
  <h1>Minha Conta</h1>
  <table>
    <tr>
      <td><a href="homepage.php">Voltar a Tela Inicial</a></td>
    </tr>
  </table>
  <h2>Visualizando os dados de: <?=$_SESSION['name']?></h2>

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
  </form>

    <a href="../deletarconta.php"> Deletar</a>
</body>
</html>
