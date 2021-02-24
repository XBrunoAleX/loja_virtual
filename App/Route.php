<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {
		 //Rotas no sistema: Se quiser modificar rotas é aqui:
			
		$routes['index'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);
		$routes['cadastrar'] = array(
			'route' => '/cadastrar',
			'controller' => 'indexController',
			'action' => 'cadastrar'
		);
		$routes['autenticar'] = array(
			'route' => '/autenticar',
			'controller' => 'AuthController',
			'action' => 'autenticar'
		);
		$routes['home'] = array(
			'route' => '/home',
			'controller' => 'lojaController',
			'action' => 'home'
		);
		$routes['produto'] = array(
			'route' => '/produto',
			'controller' => 'lojaController',
			'action' => 'produto'
		);
		$routes['destroir'] = array(
			'route' => '/destroir',
			'controller' => 'authController',
			'action' => 'destroir'
		);
		
		

		$this->setRoutes($routes);
	}

}

?>