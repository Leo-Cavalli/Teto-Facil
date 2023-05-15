
<?php

include '../users.php';

session_start();

//Verifica se o usuário está logado como administrador, caso não esteja, redireciona para a homepage
if($_SESSION['level'] != 1 || $_SESSION['id'] != 1 && $_SESSION['level' == 1] || !isset($_SESSION['id'])){
    header('Location: homepage.php');
}

//Verifica se a Página foi acessada por um link válido
if(!isset($_GET['id'])){
    header('Location: homepage.php');
}

//Exibe a mensagem do get
if(isset($_GET['msg'])){
    echo "<script>alert('".$_GET['msg']."')</script>";
}

//Cria um objeto corretor com os dados passados por get, deixa o codigo mais limpo
$auxUser = new classCorretor();
$auxUser->setUserFromDatabase($_GET['id'], $_GET['name'], $_GET['email'], $_GET['password'], $_GET['cpf'], $_GET['telefone'], $_GET['creci']);

?>

<!DOCTYPE html5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edição de Corretor: <?=$_GET['name']?></h1>
    <a href="adminPage.php">Voltar a Página de Administrador!</a>
    <table>
        <tr>
            <td>Nome: <?=$auxUser->getName()?> <a href="editStateAgent.php?id=<?=$auxUser->getId()?>&email=<?=$auxUser->getEmail()?>&cpf=<?=$auxUser->getCpf()?>&telefone=<?=$auxUser->getTelefone()?>&creci=<?=$auxUser->getCreci()?>&password=<?=$auxUser->getPassword()?>&name=<?=$auxUser->getName()?>&op=editName">Editar Nome</a></td>
        </tr>
        <tr>
            <td>Email: <?=$auxUser->getEmail()?> <a href="editStateAgent.php?id=<?=$auxUser->getId()?>&email=<?=$auxUser->getEmail()?>&cpf=<?=$auxUser->getCpf()?>&telefone=<?=$auxUser->getTelefone()?>&creci=<?=$auxUser->getCreci()?>&password=<?=$auxUser->getPassword()?>&name=<?=$auxUser->getName()?>&op=editEmail">Editar Email</a></td>
        </tr>
        <tr>
            <td>CPF: <?=$auxUser->getCpf()?> <a href="editStateAgent.php?id=<?=$auxUser->getId()?>&email=<?=$auxUser->getEmail()?>&cpf=<?=$auxUser->getCpf()?>&telefone=<?=$auxUser->getTelefone()?>&creci=<?=$auxUser->getCreci()?>&password=<?=$auxUser->getPassword()?>&name=<?=$auxUser->getName()?>&op=editCpf">Editar CPF</a></td>
        </tr>
        <tr>
            <td>Telefone: <?=$auxUser->getTelefone()?> <a href="editStateAgent.php?id=<?=$auxUser->getId()?>&email=<?=$auxUser->getEmail()?>&cpf=<?=$auxUser->getCpf()?>&telefone=<?=$auxUser->getTelefone()?>&creci=<?=$auxUser->getCreci()?>&password=<?=$auxUser->getPassword()?>&name=<?=$auxUser->getName()?>&op=editTelefone">Editar Telefone</a></td>
        </tr>
        <tr>
            <td>Creci: <?=$auxUser->getCreci()?> <a href="editStateAgent.php?id=<?=$auxUser->getId()?>&email=<?=$auxUser->getEmail()?>&cpf=<?=$auxUser->getCpf()?>&telefone=<?=$auxUser->getTelefone()?>&creci=<?=$auxUser->getCreci()?>&password=<?=$auxUser->getPassword()?>&name=<?=$auxUser->getName()?>&op=editCreci">Editar Creci</a></td>
        </tr>
        <tr>
            <td>Senha: ************ <a href="editStateAgent.php?id=<?=$auxUser->getId()?>&email=<?=$auxUser->getEmail()?>&cpf=<?=$auxUser->getCpf()?>&telefone=<?=$auxUser->getTelefone()?>&creci=<?=$auxUser->getCreci()?>&password=<?=$auxUser->getPassword()?>&name=<?=$auxUser->getName()?>&op=editPassword">Editar Senha</a></td>
        </tr>
    </table>



    <?php

        //Exibe um formulário para cada operação de edição, passada por essa propria pagina para ela mesma por GET
        if(isset($_GET['op']) && $_GET['op'] == 'editName'){
            echo '<form action="../updateProfile.php" method="post">
                    <label for="newName">Novo Nome:</label>
                    <input type="text" name="newName" id="newName" placeholder="Digite o novo nome do corretor: " maxlength="100" required>
                    <input type="hidden" name="op" value="editStateAgentName">
                    <input type="hidden" name="id_corretor" value="'.$auxUser->getId().'">
                    <input type="hidden" name="oldName" value="'.$auxUser->getName().'">
                    <input type="hidden" name="oldPassword" value="'.$auxUser->getPassword().'">
                    <input type="hidden" name="oldEmail" value="'.$auxUser->getEmail().'">
                    <input type="hidden" name="oldCpf" value="'.$auxUser->getCpf().'">
                    <input type="hidden" name="oldTelefone" value="'.$auxUser->getTelefone().'">
                    <input type="hidden" name="oldCreci" value="'.$auxUser->getCreci().'">
                    <input type="submit" value="Editar Nome">
                </form>'
                ;
        }

        if(isset($_GET['op']) && $_GET['op'] == 'editEmail'){
            echo '<form action="../updateProfile.php" method="post">
                    <label for="newEmail">Novo Nome:</label>
                    <input type="email" name="newEmail" id="newCpf" placeholder="Digite o novo Email do corretor: " maxlength="100" required>
                    <input type="hidden" name="op" value="editStateAgentEmail">
                    <input type="hidden" name="id_corretor" value="'.$auxUser->getId().'">
                    <input type="hidden" name="oldPassword" value="'.$auxUser->getPassword().'">
                    <input type="hidden" name="oldName" value="'.$auxUser->getName().'">
                    <input type="hidden" name="oldEmail" value="'.$auxUser->getEmail().'">
                    <input type="hidden" name="oldCpf" value="'.$auxUser->getCpf().'">
                    <input type="hidden" name="oldTelefone" value="'.$auxUser->getTelefone().'">
                    <input type="hidden" name="oldCreci" value="'.$auxUser->getCreci().'">
                    <input type="submit" value="Editar Email">
                </form>';
        }

        if(isset($_GET['op']) && $_GET['op'] == 'editCpf'){
            echo '<form action="../updateProfile.php" method="post">
                    <label for="newCpf">Novo Nome:</label>
                    <input type="text" name="newCpf" id="newCpf" placeholder="Digite o novo CPF do corretor: " maxlength="100" required>
                    <input type="hidden" name="op" value="editStateAgentCpf">
                    <input type="hidden" name="id_corretor" value="'.$auxUser->getId().'">
                    <input type="hidden" name="oldName" value="'.$auxUser->getName().'">
                    <input type="hidden" name="oldPassword" value="'.$auxUser->getPassword().'">
                    <input type="hidden" name="oldEmail" value="'.$auxUser->getEmail().'">
                    <input type="hidden" name="oldCpf" value="'.$auxUser->getCpf().'">
                    <input type="hidden" name="oldTelefone" value="'.$auxUser->getTelefone().'">
                    <input type="hidden" name="oldCreci" value="'.$auxUser->getCreci().'">
                    <input type="submit" value="Editar CPF">
                </form>';
        }

        if(isset($_GET['op']) && $_GET['op'] == 'editCreci'){
            echo '<form action="../updateProfile.php" method="post">
                    <label for="newCreci">Novo Nome:</label>
                    <input type="text" name="newCreci" id="newCreci" placeholder="Digite o novo Creci do corretor: " maxlength="100" required>
                    <input type="hidden" name="op" value="editStateAgentCreci">
                    <input type="hidden" name="id_corretor" value="'.$auxUser->getId().'">
                    <input type="hidden" name="oldPassword" value="'.$auxUser->getPassword().'">
                    <input type="hidden" name="oldName" value="'.$auxUser->getName().'">
                    <input type="hidden" name="oldEmail" value="'.$auxUser->getEmail().'">
                    <input type="hidden" name="oldCpf" value="'.$auxUser->getCpf().'">
                    <input type="hidden" name="oldTelefone" value="'.$auxUser->getTelefone().'">
                    <input type="hidden" name="oldCreci" value="'.$auxUser->getCreci().'">
                    <input type="submit" value="Editar Creci">
                </form>';
        }

        if(isset($_GET['op']) && $_GET['op'] == 'editTelefone'){
            echo '<form action="../updateProfile.php" method="post">
                    <label for="newTelefone">Novo Nome:</label>
                    <input type="text" name="newTelefone" id="newTelefone" placeholder="Digite o novo Telefone do corretor: " maxlength="100" required>
                    <input type="hidden" name="op" value="editStateAgentTelefone">
                    <input type="hidden" name="id_corretor" value="'.$auxUser->getId().'">
                    <input type="hidden" name="oldPassword" value="'.$auxUser->getPassword().'">
                    <input type="hidden" name="oldName" value="'.$auxUser->getName().'">
                    <input type="hidden" name="oldEmail" value="'.$auxUser->getEmail().'">
                    <input type="hidden" name="oldCpf" value="'.$auxUser->getCpf().'">
                    <input type="hidden" name="oldTelefone" value="'.$auxUser->getTelefone().'">
                    <input type="hidden" name="oldCreci" value="'.$auxUser->getCreci().'">
                    <input type="submit" value="Editar Telefone">
                </form>';
        }

        if(isset($_GET['op']) && $_GET['op'] == 'editPassword'){
            echo '<form action="../updateProfile.php" method="post">
                    <label for="newPassword">Novo Nome:</label>
                    <input type="text" name="newPassword" id="newPassword" placeholder="Digite o novo Password do corretor: " maxlength="100" required>
                    <input type="hidden" name="op" value="editStateAgentPassword">
                    <input type="hidden" name="id_corretor" value="'.$auxUser->getId().'">
                    <input type="hidden" name="oldPassword" value="'.$auxUser->getPassword().'">
                    <input type="hidden" name="oldName" value="'.$auxUser->getName().'">
                    <input type="hidden" name="oldEmail" value="'.$auxUser->getEmail().'">
                    <input type="hidden" name="oldCpf" value="'.$auxUser->getCpf().'">
                    <input type="hidden" name="oldTelefone" value="'.$auxUser->getTelefone().'">
                    <input type="hidden" name="oldCreci" value="'.$auxUser->getCreci().'">
                    <input type="submit" value="Editar Senha">
                </form>';
        }

    ?>
</body>
</html>