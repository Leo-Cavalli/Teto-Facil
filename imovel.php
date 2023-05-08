<?php

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
    
}
?>