<?php
    include_once 'database/database.php';
    include_once 'classSession.php';
    include_once 'users.php';
    include_once 'imovel.php';
    session_start();

    classUsuario::deleteUserInBd($_SESSION['id']);
    classSession::destroySession();
    header('Location: frontEnd/homepage.php?Alert=Conta Desativada!');

?>