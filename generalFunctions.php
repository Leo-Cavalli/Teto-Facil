
<?php

//Get User Name by User Id
function searchUserNameById($id){
    require "conn.php";
    $sql = "SELECT `nome` FROM `tetofacil`.`usuarios` WHERE `id_usuario` = '$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            return $row['nome'];
        }
    }else{
        return false;
    }
}

//Get User ID by User Email
function searchUserIDByEmail($email){
    require "conn.php";
    $sql = "SELECT `id_usuario` FROM `tetofacil`.`usuarios` WHERE `email` = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            return $row['id_usuario'];
        }
    }else{
        return false;
    }
}

//Get User Password by User ID
function searchUserPasswordById($id){
    require "conn.php";
    $sql = "SELECT `senha` FROM `tetofacil`.`usuarios` WHERE `id_usuario` = '$id'";
    $result = $conn -> query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            return $row['senha'];
        }
    }else{
        return false;
    }
}


//Search if email already exists in database 'usuarios' and 'corretores'
function searchEmail($email){
    require "conn.php";

    //Search if email already exists

    //Usuarios table
    $sql = "SELECT * FROM `tetofacil`.`usuarios` WHERE `email` = '$email'";

    //Corretores table
    $sql2 = "SELECT * FROM `tetofacil`.`corretores` WHERE `email` = '$email'";
    $result = $conn -> query($sql);
    $result2 = $conn -> query($sql2);
    if($result->num_rows > 0 || $result2->num_rows > 0){
        return true;
    }else{
        return false;
    }
}

//Insert new user in database
function signUpUser($name, $email, $password){
    require "conn.php";

    //Check if email already exists
    if(searchEmail($email)){
        echo "Email já cadastrado";
        return false;
    }
    

    $sql = "INSERT INTO `tetofacil`.`usuarios` (`id_usuario`, `nome`, `email`, `senha`) VALUES (NULL, '$name', '$email', '$password')";
    if($conn -> query($sql) === TRUE){

        //Get ID from new user
        $result = searchUserIdByEmail($email);
        if ($result != false){
            $id = $result;

            //Start session after sign up
            startSession($id, $name, $email);
        }
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Start Session
function startSession($id, $name, $email){
    session_start();
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    header("Location: frontEnd/homepage.php");
}

//Verify if session is started
function verifySession(){
    session_start();
    if(!isset($_SESSION['id'])){
        echo "Sessão não iniciada";
    }else{
        echo "Sessão iniciada";
    }
}



?>