<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edition area</title>
</head>
<nav>
  <!-- navegacao entre pags !-->
</nav>
<body>
  <h1>Edicao de perfil</h1>
  <form action="" method="post" id="formEdit">
    Nome: <input type="text" placeholder="Digite seu nome:" name="name" placeholder="Digite seu nome: " maxLenght= "20" >
    <br>
    Email: <input type="email" name="email" id="emailCad" placeholder="Digite seu email: " maxLenght="30">
    <br>
    Senha: <input type="password" name="password" id="senhaCad" placeholder="Digite sua senha: ">
    <br>
    Confirme senha: <input type="password" id="senhaConf" name="passwordconfirm" placeholder="Confirme sua senha: ">
    <br>
    <button type="submit" name="acao" value="cadastrar" id="sendCadButton" onclick="passwordConfirm()">cadastrar</button>
  </form>
  
</body>
</html>

<!-- Implementar uma validacao no php para ver se os antigos valores de nome, email e senha nao sao iguais !-->

<script>
  function passwordConfirm(){
    let senha = document.getElementById("senhaCad").value
    let senhaConf = document.getElementById("senhaConf").value
    if(senha != senhaConf){
      alert("As senhas nao estao iguais \nDigite senhas iguais !")
    }else{
      document.formaCad.submit()
    }
  }
</script>