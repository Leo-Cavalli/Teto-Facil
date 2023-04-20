<?php

class Database{

    const HOST = 'localhost';
    const NAME = 'tetofacil';
    const USER = 'root';
    const PASSWORD = '';

    private $table;
    private $connection;

    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    //Metodo responsavel por criar uma conexao com o banco de dados
    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASSWORD);

            // Define que o PDO lance exceções caso ocorra erros
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }

    //Metodo responsavel por executar queries dentro do banco de dados
    //@param string $query
    //@param array $params
    public function execute($query, $params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die("ERROR: Could not able to execute $query. " . $e->getMessage());
        }
    }

    //Metodo responsavel por inserir dados no banco , $values é um array com os valores a serem inseridos
    //@param array $values [ field => value ]
    public function insert($values){

        //Query data
        //Pega as chaves do array e coloca em um array
        $fields = array_keys($values);

        //Pega os valores do array e coloca em um array, caso o array tenha 3 valores, ele vai colocar 3 interrogações
        $binds = array_pad([], count($fields), '?');

        //Query
        //INSERT INTO table (name, email, password) values (?, ?, ?)
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

        //Insert into table (name, email, password) values (?, ?, ?)
        $this->execute($query, array_values($values));

        //Return last insert id
        return $this->connection->lastInsertId();

    }

    //Metodo responsavel por executar uma consulta no banco de dados
    //@param string $where  
    //@param string $order
    //@param string $limit
    //@param string $fields
    public function select($where = null, $order = null, $limit = null, $fields = '*'){

        //Query data
        //Caso o where seja passado, ele vai concatenar com o where, caso contrario ele vai concatenar com uma string vazia
        $where = strlen($where) ? 'WHERE '.$where : '';

        //Caso o order seja passado, ele vai concatenar com o order, caso contrario ele vai concatenar com uma string vazia
        $order = strlen($order) ? 'ORDER BY '.$order : '';

        //Caso o limit seja passado, ele vai concatenar com o limit, caso contrario ele vai concatenar com uma string vazia
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';
        
        //Query
        //SELECT * FROM table...
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        return $this->execute($query);

    }

    //Metodo responsavel por executar atualizações no banco de dados
    //@param string $where
    //@param array $values [field => value]
    public function update($where, $values){

        //Query data
        $fields = array_keys($values);

        //Query
        //UPDATE table SET name=?, email=?, password=? WHERE id=?
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,', $fields).'=? WHERE '.$where;

        //Execute query
        $this->execute($query, array_values($values));

        return true;

    }

    //Metodo responsavel por excluir dados do banco de dados
    public function delete($where){
        
        //Query
        //DELETE FROM table WHERE id=?
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //Execute query
        $this->execute($query);

        return true;
    }
}
