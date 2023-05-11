<?php
  session_start();
  $telefone = false;
  if(isset($_SESSION['telefone'])){
    $telefone = true;
  }

  $msgServer = '';
  if(isset($_GET['msg'])){
    $msgServer = $_GET['msg'];
  }

  $editName = false;
  if(isset($_GET['op'])  && $_GET['op'] == 'editName'){
    $editName = true;
  }

  $editEmail = false;
  if(isset($_GET['op']) && $_GET['op'] == 'editEmail'){
    $editEmail = true;
  }

  $editTelefone = false;
  if(isset($_GET['op']) && $_GET['op'] == 'editTelefone'){
    $editTelefone = true;
  }

  $editSenha = false;
  if(isset($_GET['op']) && $_GET['op'] == 'editSenha'){
    $editSenha = true;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <p><?=$msgServer?></p>
  <table>
    <tr>
      <li>Nome: <?=$_SESSION['name']?></li>

      <?php if($_SESSION['level'] != 1) echo '<a href="userPage.php?op=editName">Alterar Nome</a> '?>

      <li>CPF:  <?=$_SESSION['cpf']?></li>

      <li>Email:  <?=$_SESSION['email']?></li>

      <?php 
        
        if($_SESSION['level'] != 1) echo '<a href="userPage.php?op=editEmail">Alterar Email</a> ';

        if($telefone){
          echo '<li>Telefone:  '.$_SESSION['telefone'].'</li>';
        }else{
          echo '<li>Telefone:  Não cadastrado</li>';
        }
        
        if($_SESSION['level'] != 1) echo '<a href="userPage.php?op=editTelefone">Alterar Telefone</a> ';
      ?>

      <li>Senha: ************</li>

      <?php if($_SESSION['level'] != 1) echo '<a href="userPage.php?op=editSenha">Alterar Senha</a> '?> 

    </tr>
  </table>
  <br>

  <?php if($_SESSION['level'] != 1) echo 
          '<form action="../updateProfile.php" method="post">
            <input type="hidden" name="op" value="deleteAccount">
            <input type="submit" value="Apagar Conta">
          </form>'?>'
  <br>
  
<?php
  if($editName && $_SESSION['level'] != 1){
    echo '<form action="../updateProfile.php" method="post">
            <input type="text" name="newName" placeholder="Digite o Novo Nome:">
            <input type="hidden" name="op" value="editName">
            <input type="submit" value="Alterar Nome:">
          </form>';
  }
  if($editEmail){
    echo '<form action="../updateProfile.php" method="post">
            <input type="text" name="newEmail" placeholder="Digite o Novo Email:">
            <input type="hidden" name="op" value="editEmail">
            <input type="submit" value="Alterar Email:">
          </form>';
  }
  if($editTelefone){
    echo '<form action="../updateProfile.php" method="post">
            <input type="text" name="newTelefone" placeholder="Digite o Novo Telefone:">
            <input type="hidden" name="op" value="editTelefone">
            <input type="submit" value="Alterar Telefone:">
          </form>';
  }
  if($editSenha){
    echo '<form action="../updateProfile.php" method="post">
            <input type="text" name="newPassword" placeholder="Digite a Nova Senha:">
            <input type="hidden" name="op" value="editPassword">
            <input type="submit" value="Alterar Senha:">
          </form>';
  }
?>
</body>
</html>
