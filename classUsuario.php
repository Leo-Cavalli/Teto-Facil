<?php

require "database/database.php";

class classUsuario{

    private $id;
    private $name;
    private $email;
    private $password;

    public function setUser($name, $email, $password){
        $this->name = $name;
        $this->email = $email;
        $this->password = md5($password);
    }

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
        //Where email = $email, verificar arquivo database.php!
        //Ordem: where, order, limit
        return (new Database('usuarios')) -> select('email = "'.$email.'"')->fetchObject(self::class);
    }

    




}






?>