<?php

session_start();

echo $_SESSION['id'];
echo "<br>";
echo $_SESSION['name'];
echo "<br>";
echo $_SESSION['email'];
echo "<br>";
echo $_SESSION['level'];
echo "<br>";
echo $_SESSION['cpf'];
echo "<br>";

require_once "../imovel.php";

$imoveis = classImovel::getAllImoveis();

echo sizeof($imoveis);



?>