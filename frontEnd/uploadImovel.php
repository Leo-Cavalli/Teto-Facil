<?php

include_once '../classSession.php';

//Se o usuário desejar fazer logout
if(isset($_GET['op']) == 1){
    classSession::destroySession();
}

session_start();

//O nome Exibido no topo da pagina padrão (Visitante)
$name = "Visitante";

//O nivel de acesso do usuário padrão (Visitante)
$level = -1;

//Se o usuário estiver logado, define nome e nivel de acesso(0 = Cliente, 1 = Corretor)
if(isset($_SESSION['id'])){
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];
    if($level == 1){
        header('Location: homepage.php');
    }
}else{
    header('Location: homepage.php');
}

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
    <link rel="stylesheet" href="Stylesheets/uploadImovel.css">
    <title>Homepage</title>
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
      <h1>Solicitar Novo Anuncio</h1>

      <div class="formUploadImovel">
        <form action="../imovelform.php" method="post" enctype="multipart/form-data" id="form">
            <label for="rua">Rua:</label>
            <input type="text" name="rua" id="rua" placeholder="Rua" required class="input-field">
            <br>
            <label for="numero">Numero:</label>
            <input type="text" name="numero" id="numero" placeholder="Numero" required class="input-field">
            <br>
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" placeholder="Bairro" required class="input-field">
            <br>
            <label for="cidade">Cidade:</label>
            <input type="text" name="cidade" id="cidade" placeholder="Cidade" required class="input-field">
            <br>
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required class="input-field">
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
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id="cep" placeholder="CEP" required class="input-field">
            <br>
            <label for="tipo_imovel">Tipo Imóvel:</label>
            <select name="tipo_imovel" id="tipo_imovel" required class="input-field">
            <option value="Casa">Casa</option>
            <option value="Apartamento">Apartamento</option>
            <option value="Sobrado">Sobrado</option>
            </select>
            <br>
            <label for="complemento">Complemento:</label>
            <input type="text" name="complemento" id="complemento" placeholder="Complemento" required class="input-field">
            <br>
            <label for="descricao">Descrição:</label>
            <br>
            <textarea name="descricao" id="descricao" cols="30" rows="10" placeholder="Descrição" required class="input-field"></textarea>
            <br>
            <label for="valor">Valor:</label>
            <input type="text" name="valor" id="valor" placeholder="Valor" required class="input-field">
            <br>
            <input type="file" name="foto" required>
            <br>
            <input type="submit" value="Enviar Solicitação">
        </form>
</div>
    </div>

    <script>
    function validateForm() {
        var rua = document.getElementById("rua").value;
        var numero = document.getElementById("numero").value;
        var bairro = document.getElementById("bairro").value;
        var cidade = document.getElementById("cidade").value;
        var estado = document.getElementById("estado").value;
        var cep = document.getElementById("cep").value;
        var tipoImovel = document.getElementById("tipo_imovel").value;
        var descricao = document.getElementById("descricao").value;
        var valor = document.getElementById("valor").value;

        if (rua === "" || numero === "" || bairro === "" || cidade === "" || estado === "" || cep === "" || tipoImovel === "" || descricao === "" || valor === "") {
            alert("Por favor, preencha todos os campos obrigatórios.");
            event.preventDefault();
        } else {
            var pattern = /^\d{5}-\d{3}$/;
            if (pattern.test(cep)) {
                form.submit();
            } else {
                alert("CEP inválido. Por favor, insira um CEP válido.\nModelo válido: xxxxx-xxx");
                event.preventDefault();
            }
        }
    }
</script>


</body>
</html>