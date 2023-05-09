<?php

include_once '../classSession.php';

if(isset($_GET['op']) == 1){
    classSession::destroySession();
}

session_start();

$name = "Visitante";

$level = -1;

if(isset($_SESSION['id'])){
    $name = $_SESSION['name'];
    $level = $_SESSION['level'];
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>Olá, <?=$name?><?php if($level == 1 && $_SESSION['id'] != 1) echo ' CONTA DE CORRETOR'?></h1>
    <table>
        <tr>
            <?php
                //Se o usuário for um corretor ou um cliente
                if($level == 0 || $level == 1 && $_SESSION['id'] != 1){
                    echo '<td><a href="userPage.php">Minha Conta</a></td>';
                    echo '<td><a href="homepage.php?op=1">LogOut</a></td>';
                }
                //Se o usuário não estiver logado
                else if(!isset($_SESSION['id'])){
                    echo '<td><a href="loginpage.php">Tela de Login</a></td>';
                }
                //Se o usuário estiver logado como administrador
                else if($level != null && $level == 1 && $_SESSION['id'] == 1){
                    echo '<td><a href="adminPage.php">Painel de Admin</a></td>';
                    echo '<td><a href="homepage.php?op=1">LogOut</a></td>';
                }
            ?>
        </tr>
    </table>
</body>
</html>