<?php
namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;

class authController extends Action{

    public function autenticar(){
        
        $usuario= Container::getModel('Usuario');

        $usuario->__set('email',$_POST['email']);
        $usuario->__set('senha',$_POST['senha']);
        
        $usuario->autenticarNoBanco();

       // echo '<script>';
       // echo 'console.log('. json_encode($usuario->__get('idUsuario') ) .')';
        // echo '</script>';
        
        if ($usuario->__get('idUsuario') !='' && $usuario->__get('nome') !=''){

            session_start();
            
            $_SESSION['idUsuario']=$usuario->__GET('idUsuario');
            $_SESSION['nome']=$usuario->__GET('nome');
            $_SESSION['email']=$usuario->__GET('email');
            
            

            header('location: /home');
            
        }else{
            
            header('location: /?login=erros');
        }
    }
    
    public function destroir(){
        session_start();
        session_destroy();
        
        header('location:/');
    }
}


?>