<?php

namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		
		$this->view->login=isset($_GET['login']) ? $_GET['login'] : '';
		$usuario=Container::getModel('Usuario');
		$usuario->__set('email',$_GET['email']);
		$usuario->__set('senha',$_GET['senha']);
		$malandro=$usuario->autenticarNoBanco();

		$this->view->conectado=print_r($malandro);
 
		$this->render('index');
	}


	public function cadastrar(){
		// Igual a instanciar um new usuario, Mas neste caso o Conteiner retorna o Usuario com a conexão do Banco ja instanciado (passando pelo getModel qual Model instanciar)
		$usuario=Container::getModel('Usuario');
		$usuario->__set('nome',$_POST['nome_cad']);
		$usuario->__set('email',$_POST['email_cad']);
		$usuario->__set('senha',$_POST['senha_cad']);

		//Verificando se todos os dados importantes foram preenchidos no cadastro
		if(strlen($_POST['senha_cad']) >5 && strlen($_POST['nome_cad'])>5 && strlen($_POST['email_cad']) >5){
			//Validando se email ja foi inserido no banco
			if($_POST['senha_cad']== $_POST['confirm_cad']){
				if (count($usuario->validarEmail()) == 0){
					$usuario->cadastrarUsuarioNoBanco();
					$this->render('cadastrado');

				}else {
					$this->render('index');
				}
			}else{
				header('location:/?senhas=erro');
			}
		}else{
			header('location:/?senhas=dados');
		}
	}
}


?>