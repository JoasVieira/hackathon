<?php
	define('SERVER', 'localhost');
	define('BANCO', 'hackathon');
	define('USUARIO', 'root');
	define('SENHA', '');

	try {
		$pdo = new PDO("mysql:host=".SERVER.";dbname=".BANCO.";charset=utf8",USUARIO,SENHA);

  } catch (PDOException $erro) {
		echo '<p>Erro ao tentar conectar no banco de dados:</p>';
		echo $erro->getMessage();
	}
