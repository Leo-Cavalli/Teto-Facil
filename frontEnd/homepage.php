<?php
    require "../generalFunctions.php";
    verifySession();
    
    echo " Bem vindo, " . $_SESSION['name'];

?>