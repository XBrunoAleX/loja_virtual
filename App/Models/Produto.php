<?php
namespace App\Models;

use MF\Model\Model;

class Produto extends Model {
    private $idProduto;
    private $nome;
    private $descricao;
    private $preco;
    private $categoria;


    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo,$valor){
        $this->$atributo=$valor;
    }

    //salvar
    //recuperar

    public function getAllProdutos(){
        $query="SELECT idProduto,nome,descricao,preco,categoria from produto";
        $stmt= $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProduto(){
        $query="SELECT idProduto,nome,descricao,preco,categoria from produto WHERE idProduto= :id";
        $stmt= $this->db->prepare($query);
        $stmt->bindValue(':id',$this->__get('idProduto'));
        $stmt->execute();

        $produto= $stmt->fetch(\PDO::FETCH_ASSOC);

        if (isset($produto['idProduto'])){
            if ($produto['nome'] != '' && $produto['idProduto'] != ''){
                
                $this->__set('nome',$produto['nome'] );
                $this->__set('idProduto',$produto['idProduto']);
                $this->__set('descricao',$produto['descricao']);
                $this->__set('preco',$produto['preco']);
                $this->__set('categoria',$produto['categoria']);
            }            
        }

        return $this;
    }
    
}