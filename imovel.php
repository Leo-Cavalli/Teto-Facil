<?php

require_once "database/database.php";

class classImovel{
    private $id;
    private $id_anunciante;
    private $id_corretor = null;
    private $tipo_imovel;
    private $cep;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $valor;
    private $complemento;
    private $descricao;
    private $situacao;

    //Getters and Setters
    public function getId() {
        return $this->id;
    }
    public function setId($value) {
        $this->id = $value;
    }

    public function getId_anunciante() {
        return $this->id_anunciante;
    }
    public function setId_anunciante($value) {
        $this->id_anunciante = $value;
    }

    public function getId_corretor() {
        return $this->id_corretor;
    }
    public function setId_corretor($value) {
        $this->id_corretor = $value;
    }

    public function getTipo_imovel() {
        return $this->tipo_imovel;
    }
    public function setTipo_imovel($value) {
        $this->tipo_imovel = $value;
    }

    public function getCep() {
        return $this->cep;
    }
    public function setCep($value) {
        $this->cep = $value;
    }

    public function getRua() {
        return $this->rua;
    }
    public function setRua($value) {
        $this->rua = $value;
    }

    public function getNumero() {
        return $this->numero;
    }
    public function setNumero($value) {
        $this->numero = $value;
    }

    public function getBairro() {
        return $this->bairro;
    }
    public function setBairro($value) {
        $this->bairro = $value;
    }

    public function getCidade() {
        return $this->cidade;
    }
    public function setCidade($value) {
        $this->cidade = $value;
    }

    public function getEstado() {
        return $this->estado;
    }
    public function setEstado($value) {
        $this->estado = $value;
    }

    public function getValor() {
        return $this->valor;
    }
    public function setValor($value) {
        $this->valor = $value;
    }

    public function getComplemento() {
        return $this->complemento;
    }
    public function setComplemento($value) {
        $this->complemento = $value;
    }

    public function getDescricao() {
        return $this->descricao;
    }
    public function setDescricao($value) {
        $this->descricao = $value;
    }

    public function getSituacao() {
        return $this->situacao;
    }
    public function setSituacao($value) {
        $this->situacao = $value;
    }

    //Metodo responsavel por setar os valores do objeto imovel, sem id.
    public function setImovel($id_anunciante, $id_corretor, $tipo_imovel, $cep, $rua, $numero, $bairro, $cidade, $estado, $valor, $complemento, $descricao, $situacao){
        $this->id_anunciante = $id_anunciante;
        $this->id_corretor = $id_corretor;
        $this->tipo_imovel = $tipo_imovel;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->valor = $valor;
        $this->complemento = $complemento;
        $this->descricao = $descricao;
        $this->situacao = $situacao;
    }

    //Metodo responsavel por cadastrar um imovel no banco de dados
    public function ImovelToBd(){
        $database = new database('imoveisdefinitivos');
        
        $this->id = $database->insert([
            'id_anunciante' => $this->id_anunciante,
            'id_corretor' => $this->id_corretor,
            'tipo_imovel' => $this->tipo_imovel,
            'cep' => $this->cep,
            'rua' => $this->rua,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'valor' => $this->valor,
            'complemento' => $this->complemento,
            'descricao' => $this->descricao,
            'situacao' => $this->situacao
        ]);
        return true;
    }

    //Metodo responsavel por setar os valores do objeto imovel, com id.
    public function setImovelFromBD($id, $id_anunciante, $id_corretor, $tipo_imovel, $cep, $rua, $numero, $bairro, $cidade, $estado, $valor, $complemento, $descricao, $situacao){
        $this->id = $id;
        $this->id_anunciante = $id_anunciante;
        $this->id_corretor = $id_corretor;
        $this->tipo_imovel = $tipo_imovel;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->valor = $valor;
        $this->complemento = $complemento;
        $this->descricao = $descricao;
        $this->situacao = $situacao;
    }

    //Retorna uma lista com os imoveis de um usuario pelo seu ID
    public static function getImovelByUserId($userID){
        $database = new database('imoveisdefinitivos');
        
        $result = $database->select('id_anunciante = "'.$userID.'"');

        $imoveis = array();

        if($result->rowCount() > 0){

            while($row = $result->fetch()){

                $imovelAux = new classImovel();

                $imovelAux->setImovelFromBD($row['id_imovel'], $row['id_anunciante'], $row['id_corretor'], $row['tipo_imovel'], $row['cep'], $row['rua'], $row['numero'], $row['bairro'], $row['cidade'], $row['estado'], $row['valor'], $row['complemento'], $row['descricao'], $row['situacao']);

                array_push($imoveis, $imovelAux);
            }
        }
        return $imoveis;
    }

    //Retorna uma lista com todos os imoveis cadastrados no banco de dados
    public static function getAllImoveis(){
        $database = new database('imoveisdefinitivos');

        $result = $database->select();

        $imoveis = array();

        if($result->rowCount() > 0){

            while($row = $result->fetch()){
                $imovelAux = new classImovel();

                $imovelAux->setImovelFromBD($row['id_imovel'], $row['id_anunciante'], $row['id_corretor'], $row['tipo_imovel'], $row['cep'], $row['rua'], $row['numero'], $row['bairro'], $row['cidade'], $row['estado'], $row['valor'], $row['complemento'], $row['descricao'], $row['situacao']);
                
                array_push($imoveis, $imovelAux);
            }
        }
        return $imoveis;
    }
    
    //Retorna todos os imoveis de um corretor pelo seu ID
    public static function getImovelByStateAgentID($id){
        $database = new database('imoveisdefinitivos');

        $imoveis = array();

        $result = $database->select('id_corretor = "'.$id.'"');

        if($result->rowCount() > 0){
            while($row = $result->fetch()){

                $imovelAux = new classImovel();

                $imovelAux->setImovelFromBD($row['id_imovel'], $row['id_anunciante'], $row['id_corretor'], $row['tipo_imovel'], $row['cep'], $row['rua'], $row['numero'], $row['bairro'], $row['cidade'], $row['estado'], $row['valor'], $row['complemento'], $row['descricao'], $row['situacao']);
                
                array_push($imoveis, $imovelAux);
            }
        }

        return $imoveis;
    }

}
?>