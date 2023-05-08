
<?php

  require "../classSession.php";
  if(!classSession::verifySession()){
    header("Location: loginpage.php");
    exit();
  }

  print_r($_SESSION);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imoveis</title>
</head>
<body>
  
  <nav>
    <!-- Colocar uma aba de navegacao entre paginas !-->
  </nav>

  <form action="../imovelform.php" method="post">

    <input type="text" id="cep" placeholder="Digite seu CEP: " name="cep" required>
    <br>

    <input type="text" name="rua" id="rua" placeholder="Digite o nome da rua" required>
    <br>

    <input type="text" id="number" name="numero" placeholder ="Digite o numero: " required>
    <br>

    <input type="text" id="bairro" name="bairro" placeholder="Digite o nome do Bairro" required>
    <br>

    <input type="text" id="cidade" name="cidade" placeholder="Digite o nome da cidade">
    <br>

    <select id="estado" name="estado">
      <option value="AC">Acre</option>
      <option value="AL">Alagoas</option>
      <option value="AP">Amapá</option>
      <option value="AM">Amazonas</option>
      <option value="BA">Bahia</option>
      <option value="CE">Ceará</option>
      <option value="DF">Distrito Federal</option>
      <option value="ES">Espírito Santo</option>
      <option value="GO">Goiás</option>
      <option value="MA">Maranhão</option>
      <option value="MT">Mato Grosso</option>
      <option value="MS">Mato Grosso do Sul</option>
      <option value="MG">Minas Gerais</option>
      <option value="PA">Pará</option>
      <option value="PB">Paraíba</option>
      <option value="PR">Paraná</option>
      <option value="PE">Pernambuco</option>
      <option value="PI">Piauí</option>
      <option value="RJ">Rio de Janeiro</option>
      <option value="RN">Rio Grande do Norte</option>
      <option value="RS">Rio Grande do Sul</option>
      <option value="RO">Rondônia</option>
      <option value="RR">Roraima</option>
      <option value="SC">Santa Catarina</option>
      <option value="SP">São Paulo</option>
      <option value="SE">Sergipe</option>
      <option value="TO">Tocantins</option>
    </select>
    <br>

    <input type="text" id="complemento" placeholder="Digite o complemento: " name="complemento">
    <br>

    <select name="tipoImovel" id="tipoImovel" required>
      <option value="Casa" id="casa">Casa</option>
      <option value="Apartamento" id="apartamento">Apartamento</option>
      <option value="Sobrado" id="sobrado">Sobrado</option>
      <option value="Duplex" id="duplex">Duplex</option>
      <option value="CasaCondominio" id="casaCondominio">Casa em Condominio</option>
      <option value="Kitnet" id="kitnet">Kitnet</option>2
      <option value="Estudio" id="estudio">Estudio</option>
      <option value="Loft" id="loft">Loft</option>
    </select>
    <br>

    <textarea name="descricao" id="descricao" cols="30" rows="10" placeholder="Digite uma descricao de seu imovel" required>
    </textarea>
    <br>

    <input type="submit" value="Enviar">
  </form>
</body>
</html>