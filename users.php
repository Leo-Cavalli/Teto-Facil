<?php

require_once "database/database.php";

class classUsuario{

    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $cpf;
    protected $telefone;

    //Metodo responsavel por setar os valores do objeto usuario, utilizado para cadastro
    public function setUser($name, $email, $password, $cpf){
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->cpf = $cpf;
    }

    //Metodos responsaveis por retornar os valores do objeto usuario
    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    
    //Metodo responsavel por setar os valores do objeto usuario, utilizado durante o login
    public function setUserFromDatabase($id, $name, $email, $password, $cpf, $telefone){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
    }

    //Metodo responsavel por cadastrar um usuario no banco de dados
    public function signUp(){
        $database = new database('usuario');
            
        $this->id = $database->insert([
                    'nome' => $this->name,
                    'email' => $this->email,
                    'senha' => $this->password,
                    'cpf' => $this->cpf
                    ]);        
        return true;
    }
    //Metodo responsavel por retornar um objeto usuario a partir do seu email
    public static function getUserByEmail($email){

        //Cria uma instacia de database na tabela usuários
        $database = new database('usuario');

        //Realiza o select no banco de dados
        $result = $database->select('email = "'.$email.'"');

        //Verifica se o select retornou algum resultado
        if($result->rowCount() > 0){

            //Pega o resultado do select
            $row = $result->fetch();

            //Cria um objeto usuario
            $auxUser = new classUsuario();

            //Seta os valores do objeto usuario
            $auxUser->setUserFromDatabase($row['id_usuario'], $row['nome'], $row['email'], $row['senha'], $row['cpf'], $row['telefone']);
            
            //Retorna o objeto usuario
            return $auxUser;
        }

        //Retorna falso caso não encontre o usuario
        return false;
    }

    public static function getUserByCpf($cpf){
        $database = new Database('usuario');

        $result = $database->select('cpf = "'.$cpf.'"');

        if($result->rowCount() > 0){
            $row = $result->fetch();

            $auxUser = new classUsuario();

            $auxUser->setUserFromDatabase($row['id_usuario'], $row['nome'], $row['email'], $row['senha'], $row['cpf'], $row['telefone']);

            return $auxUser;
        }

        return false;
    }

    public static function getUserById($id){
        $database = new Database('usuario');
        $result = $database->select('id_usuario = "'.$id.'"');
        if($result->rowCount() > 0){
            $row = $result->fetch();
            $auxUser = new classUsuario();
            $auxUser->setUserFromDatabase($row['id_usuario'], $row['nome'], $row['email'], $row['senha'], $row['cpf'], $row['telefone']);
            return $auxUser;
        }
        return false;
    }

    //Update Name in BD
    public static function editNameInBd($where, $newName){
        $database = new database('usuario');
        $database->update('id_usuario = "'.$where.'"', [
            'nome' => $newName
        ]);
        return true;
    }

    //Update Email in BD
    public static function editEmailInBd($where, $newEmail){
        $database = new database('usuario');
        $database->update('id_usuario = "'.$where.'"', [
            'email' => $newEmail
        ]);
        return true;
    }

    //Update CPF in BD
    public static function editTelefoneInBd($where, $newTelefone){
        $database = new database('usuario');
        $database->update('id_usuario = "'.$where.'"', [
            'telefone' => $newTelefone
        ]);
        return true;
    }


    //Update Password in BD
    public static function editPasswordInBd($where, $newPassword){
        $database = new database('usuario');
        $database->update('id_usuario = "'.$where.'"', [
            'senha' => $newPassword
        ]);
        return true;
    }

    //Delete User in BD
    public static function deleteUserInBd($where){
        $database = new database('usuario');
        $database->delete('id_usuario = "'.$where.'"');
        return true;
    }
}

class classCorretor extends classUsuario{
    private $creci;

    //Metodo responsavel por retornar o valor do atributo creci
    public function getCreci(){
        return $this->creci;
    }

    //Metodo responsavel por setar o valor do atributo creci
    public function setCreci($creci){
        $this->creci = $creci;
    }

    //Metodo responsavel por setar os valores do objeto corretor, utilizado para login
    public function setUserFromDatabase($id, $name, $email, $password, $cpf, $telefone, $creci = null){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->creci = $creci;
    }

    //Metodo responsavel por setar os atributos do objeto corretor
    public function setUser($name, $email, $password, $cpf, $telefone = null, $creci = null){
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->creci = $creci;
    }

    //Insere o objeto corretor no banco de dados
    public function signUp(){
        $database = new database('corretor');
            
        $this->id = $database->insert([
                    'nome' => $this->name,
                    'email' => $this->email,
                    'senha' => $this->password,
                    'creci' => $this->creci,
                    'cpf' => $this->cpf,
                    'telefone' => $this->telefone
                    ]);        
        return true;
    }

    //Metodo responsavel por retornar um objeto do tipo corretor por seu email
    public static function getUserByEmail($email){

        //Cria uma instancia de database na tabela corretor
        $database = new database('corretor');

        //Realiza o select no banco de dados
        $result = $database->select('email = "'.$email.'"');

        //Verifica se o select retornou algum resultado
        if($result->rowCount() > 0){

            //Pega o resultado do select
            $row = $result->fetch();

            //Cria um objeto corretor
            $auxStateAgent = new classCorretor();

            //Seta os valores do objeto corretor
            $auxStateAgent->setUserFromDatabase($row['id_corretor'], $row['nome'], $row['email'], $row['senha'], $row['telefone'], $row['creci']);

            //Retorna o objeto corretor
            return $auxStateAgent;

        }
        //Retorna falso caso não encontre o corretor
        return false;
    }

    public static function getUserByCpf($cpf){
        $database = new Database('corretor');

        $result = $database->select('cpf = "'.$cpf.'"');

        if($result->rowCount() > 0){
            $row = $result->fetch();

            $auxStateAgent = new classCorretor();

            $auxStateAgent->setUserFromDatabase($row['id_corretor'], $row['nome'], $row['email'], $row['senha'], $row['telefone'], $row['creci']);

            return $auxStateAgent;
        }

        return false;
    }

    public static function getStateAgentById($id){
        $database = new Database('corretor');

        $result = $database->select('id_corretor = "'.$id.'"');

        if($result->rowCount() > 0){
            $row = $result->fetch();

            $auxStateAgent = new classCorretor();

            $auxStateAgent->setUserFromDatabase($row['id_corretor'], $row['nome'], $row['email'], $row['senha'], $row['telefone'], $row['creci']);

            return $auxStateAgent;
        }

        return false;
    }

    public static function getUserByCreci($creci){
        $database = new Database('corretor');

        $result = $database->select('creci = "'.$creci.'"');

        if($result->rowCount() > 0){
            $row = $result->fetch();

            $auxStateAgent = new classCorretor();

            $auxStateAgent->setUserFromDatabase($row['id_corretor'], $row['nome'], $row['email'], $row['senha'], $row['telefone'], $row['creci']);

            return $auxStateAgent;
        }

        return false;
    }
    

    //Retorna uma lista com todos os corretor cadastrados no banco de dados
    public static function getAllStateAgentsfromBd(){
    
        $StateAgents = array();

        $database = new database('corretor');

        $result = $database->select("id_corretor > 1");
    
        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $auxStateAgent = new classCorretor();
                
                $auxStateAgent->setUserFromDatabase($row['id_corretor'],
                $row['nome'], $row['email'], $row['senha'], $row['cpf'], $row['telefone'], $row['creci']);
                
                array_push($StateAgents, $auxStateAgent);
            }
        }
        return $StateAgents;
    }

    //Deleta um corretor do banco de dados, mudar nome do metodo para deleteUserInBd
    public static function deleteStateAgent($id){
        $database = new database('corretor');

        $database->delete('id_corretor = "'.$id.'"');

        return true;
    }


    //Update Name in BD
    public static function editNameInBd($where, $newName){
        $database = new database('corretor');
        $database->update('id_corretor = "'.$where.'"', [
            'nome' => $newName
        ]);
        return true;
    }

    //Update Email in BD
    public static function editEmailInBd($where, $newEmail){
        $database = new database('corretor');
        $database->update('id_corretor = "'.$where.'"', [
            'email' => $newEmail
        ]);
        return true;
    }

    //Update CPF in BD
    public static function editCpfInBd($where, $newCpf){
        $database = new database('corretor');
        $database->update('id_corretor = "'.$where.'"', [
            'cpf' => $newCpf
        ]);
        return true;
    }

    //Update Creci in BD
    public static function editCreciInBd($where, $NewCreci){
        $database = new database('corretor');
        $database->update('id_corretor = "'.$where.'"', [
            'creci' => $NewCreci
        ]);
        return true;
    }

    //Update Telefone in BD
    public static function editTelefoneInBd($where, $newTelefone){
        $database = new database('corretor');
        $database->update('id_corretor = "'.$where.'"', [
            'telefone' => $newTelefone
        ]);
        return true;
    }

    //Update Password in BD
    public static function editPasswordInBd($where, $newPassword){
        $database = new database('corretor');
        $database->update('id_corretor = "'.$where.'"', [
            'senha' => $newPassword
        ]);
        return true;
    }

    public static function verifyIfEmailAlreadExists($id, $email){
        $databaseCorretores = new database('corretor');
        $databaseClientes = new database('usuario');

        $resultCorretores = $databaseCorretores->select('email = "'.$email.'" AND id_corretor != "'.$id.'"');
        $resultClientes = $databaseClientes->select('email = "'.$email.'"');
        if($resultCorretores->rowCount() > 0 || $resultClientes->rowCount() > 0){
            return true;
        }
        return false;
    }

    public static function verifyIfCpfAlreadExists($id, $cpf){
        $databaseCorretores = new database('corretor');
        $databaseClientes = new database('usuario');

        $resultCorretores = $databaseCorretores->select('cpf = "'.$cpf.'" AND id_corretor != "'.$id.'"');
        $resultClientes = $databaseClientes->select('cpf = "'.$cpf.'"');
        if($resultCorretores->rowCount() > 0 || $resultClientes->rowCount() > 0){
            return true;
        }
        return false;
    }

    public static function verifyIfCreciAlreadExists($id, $cpf){
        $databaseCorretores = new database('corretor');

        $resultCorretores = $databaseCorretores->select('creci = "'.$cpf.'" AND id_corretor != "'.$id.'"');
        if($resultCorretores->rowCount() > 0){
            return true;
        }
        return false;
    }

    public static function getUserById($id)
    {
        $database = new Database('corretor');
        $result = $database->select('id_corretor = "'.$id.'"');
        if($result->rowCount() > 0){
            $row = $result->fetch();
            $auxStateAgent = new classCorretor();
            $auxStateAgent->setName($row['nome']);
            $auxStateAgent->setEmail($row['email']);
            $auxStateAgent->setCpf($row['cpf']);
            $auxStateAgent->setTelefone($row['telefone']);
            $auxStateAgent->setCreci($row['creci']);
            return $auxStateAgent;
        }
        return false;
    }

    public function getId(){
        return $this->id;
    }
    
}
?>