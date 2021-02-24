<?php
namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;


class lojaController extends Action{
    
    public function home(){

       session_start();
        //o usuario só passara daqui se ele ja foi autenticado
        if (isset($_SESSION['idUsuario'])){
            if ($_SESSION['idUsuario'] != '' && $_SESSION['nome'] != ''){
                $this->view->nomeCompleto=$_SESSION['nome'];
                $nome=explode(' ',$_SESSION['nome']);
                $this->view->nome= $nome[0];
                $this->view->email=$_SESSION['email'];
                
                $produto= Container::getModel('Produto');
               
                $top=$produto->getAllProdutos();

                $this->view->produto= $top;

               
                $this->render('home');
                
            }
        }else {
            header('location:/');
        }
    }
    public function produto(){
        session_start();
        //o usuario só passara daqui se ele ja foi autenticado
        if (isset($_SESSION['idUsuario'])){
            if ($_SESSION['idUsuario'] != '' && $_SESSION['nome'] != ''){
                $this->view->nomeCompleto=$_SESSION['nome'];
                $nome=explode(' ',$_SESSION['nome']);
                $this->view->nome= $nome[0];
                $this->view->email=$_SESSION['email'];
                
                $produto= Container::getModel('Produto');
                $produto->__set('idProduto',$_GET['id']);
                $produto->getProduto();


                $this->view->nomeProduto=$produto->__get('nome');
                $this->view->descricao=$produto->__get('descricao');
                $this->view->preco=$produto->__get('preco');
                $this->view->categoria=$produto->__get('categoria');
                

                $this->render('Produto');
                
            }
        }else {
            header('location:/');
        }
    }



    //Essa função autentica sempre o usuario para ele não entrar no sistema sem os proprios dados
    public function autentica($view){
        session_start();
        //o usuario só passara daqui se ele ja foi autenticado
        if (isset($_SESSION['idUsuario'])){
            if ($_SESSION['idUsuario'] != '' && $_SESSION['nome'] != ''){
              
                $this->view->nomeCompleto=$_SESSION['nome'];
                
                $nome=explode(' ',$_SESSION['nome']);
                $this->view->nome= $nome[0];

                $this->view->email=$_SESSION['email'];
                
                $this->render($view);
                
            }
        }else {
            header('location:/');
        }
    }
}


?>