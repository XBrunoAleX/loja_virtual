<?php

namespace App;

class Connection {

	public static function getDb() {
		try {	
			//ATENÇÃO: Quando for usar o PDO: ele é uma classe da raiz do PHP, como estamos usando nameSpace ele vai buscar a classe dele aqui, para fazer ele funcionar é necessario indicar que é uma classe da raiz do PHP(com Barra: \PDO );

			$conn = new \PDO(
				"mysql:host=localhost;dbname=loja_bruno;charset=utf8",
				"root",
				"" 
			);

			return $conn;

		} catch (\PDOException $e) {
			echo "<h2>erro na conecxão</h2> (App/connection.php)";
		}
	}
}

?>