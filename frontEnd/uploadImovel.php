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

  <form action="" method="post">
    <input type="text" id="adress" placeholder="Digite seu endereco: " required>
    <br>
    <input type="text" id="number" placeholder ="Digite o numero: " required>
    <br>
    <input type="text" id="complement" placeholer="Digite o complemento: ">
    <br>
    <select name="tipoImovel" id="tipoImovel" required>
      <option value="casa" id="casa">Casa</option>
      <option value="apartamento" id="apartamento">Apartamento</option>
      <option value="sobrado" id="sobrado">Sobrado</option>
      <option value="duplex" id="duplex">Duplex</option>
      <option value="casaCondominio" id="casaCondominio">Casa em Condominio</option>
      <option value="kitnet" id="kitnet">Kitnet</option>
      <option value="estudio" id="estudio">Estudio</option>
      <option value="loft" id="loft">Loft</option>
    </select>

    <textarea name="description" id="description" cols="30" rows="10" placeholder="Digite uma descricao de seu imovel">
    </textarea>

    <input type="submit" value="Enviar">
  </form>
</body>
</html>