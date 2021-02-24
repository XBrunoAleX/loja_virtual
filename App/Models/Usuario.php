<?php
namespace App\Models;

use MF\Model\Model;

class Usuario extends Model {

   private $idUsuario;
   private $email;
   private $nome;
   private $senha;
    
   public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo,$valor){
        $this->$atributo=$valor;
    }

    public function validarEmail(){
        $query = "select nome, email from usuarios where email = :email";
        $stmt=$this->db->prepare($query);
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO ::FETCH_ASSOC);
    }

    public function cadastrarUsuarioNoBanco(){
        $query="insert into usuarios(email,nome, senha) values (:email,:nome,:senha )";
        $stmt=$this->db->prepare($query);
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->bindValue(':nome',$this->__get('nome'));
        $stmt->bindValue(':senha',$this->__get('senha'));

        $stmt->execute();
        return $this;
    }

    public function autenticarNoBanco(){
        $query="select idUsuario,nome,Email from usuarios where Email= :email and senha= :senha";
        $stmt=$this->db->prepare($query);
        $stmt->bindValue(':email',$this->__get('email'));
        $stmt->bindValue(':senha',$this->__get('senha'));
        $stmt->execute();

        $usuario= $stmt->fetch(\PDO::FETCH_ASSOC);

       

        if (isset($usuario['nome'])){
            if ($usuario['nome'] != '' && $usuario['idUsuario'] != ''){
                $this->__set('nome',$usuario['nome'] );
                $this->__set('idUsuario',$usuario['idUsuario']);
                $this->__set('email',$usuario['Email']);
                
            }            
        }
       
       
        return $this;
    }


}
?>