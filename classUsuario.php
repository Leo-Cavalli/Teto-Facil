<?php

require "database/database.php";

class classUsuario{

    public $id;
    public $name;
    public $email;
    public $password;

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
    public static function getUsuarioPorEmail($email){
        //Where email = $email, verificar arquivo database.php!
        //Ordem: where, order, limit
        return (new Database('usuarios')) -> select('email = "'.$email.'"')->fetchObject(self::class);
    }




}






?>