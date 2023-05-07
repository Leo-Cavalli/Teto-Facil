<?php

require "database/database.php";

class classUsuario{

    private $id;
    private $name;
    private $email;
    private $password;

    //Metodo responsavel por setar os valores do objeto usuario, utilizado para cadastro
    public function setUser($name, $email, $password){
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    //Metodos responsaveis por retornar os valores do objeto usuario
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    
    //Metodo responsavel por setar os valores do objeto usuario, utilizado durante o login
    public function setUserFromDatabase($id, $name, $email, $password){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    //Metodo responsavel por cadastrar um usuario no banco de dados
    public function signUp(){
        $database = new database('usuarios');
            
        $this->id = $database->insert([
                    'nome' => $this->name,
                    'email' => $this->email,
                    'senha' => $this->password
                    ]);        
        return true;
    }
    //Metodo responsavel por retornar um objeto usuario a partir do seu email
    public static function getUserByEmail($email){

        //Cria uma instacia de database na tabela usuários
        $database = new database('usuarios');

        //Realiza o select no banco de dados
        $result = $database->select('email = "'.$email.'"');

        //Verifica se o select retornou algum resultado
        if($result->rowCount() > 0){

            //Pega o resultado do select
            $row = $result->fetch();

            //Cria um objeto usuario
            $auxUser = new classUsuario();

            //Seta os valores do objeto usuario
            $auxUser->setUserFromDatabase($row['id_usuario'], $row['nome'], $row['email'], $row['senha']);
            
            //Retorna o objeto usuario
            return $auxUser;
        }

        //Retorna falso caso não encontre o usuario
        return false;
    }
}

class classCorretor extends classUsuario{
    private $creci;

    public function getCreci(){
        return $this->creci;
    }

    //Metodo responsavel por setar os valores do objeto corretor, utilizado para login
    public function setUserFromDatabase($id, $name, $email, $password, $creci){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->creci = $creci;
    }

    //Metodo responsavel por setar os atributos do objeto corretor
    public function setUser($name, $email, $password, $creci){
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->creci = $creci;
    }

    //Insere o objeto corretor no banco de dados
    public function signUp(){
        $database = new database('corretores');
            
        $this->id = $database->insert([
                    'nome' => $this->name,
                    'email' => $this->email,
                    'senha' => $this->password,
                    'creci' => $this->creci
                    ]);        
        return true;
    }

    //Metodo responsavel por retornar um objeto do tipo corretor por seu email
    public static function getUserByEmail($email){

        $database = new database('corretores');

        $result = $database->select('email = "'.$email.'"');

        if($result->rowCount > 0){

            $row = $result->fetch();

            $auxStateAgent = new classCorretor();

            $auxStateAgent->setUserFromDatabase($row['id_corretor'], $row['nome'], $row['email'], $row['senha'], $row['creci']);

            return $auxStateAgent;

        }
        return false;
    }
}





?>