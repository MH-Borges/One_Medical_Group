<?php

// $servidor = 'localhost';
// $usuario = 'root';
// $senha = '';
// $banco = 'one_medical_group';


$servidor = 'localhost';
$usuario = 'OneRoot';
$senha = 'One_Medical_Group312';
$banco = 'One_Medical_Group';

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");

	//CONEXAO MYSQLI PARA O BACKUP
	$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

} catch (Exception $e) {
	echo "Erro ao conectar com o banco de dados! " . $e;
}

?>