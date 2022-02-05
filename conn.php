<?php

$producao = true;
if($producao){
	// Database configuration
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "videoke";
}else{
	// Database configuration
	$hostname = "localhost";
	$username = "agenciao_videoke";
	$password = "agencia5859262";
	$database = "agenciao_videoke";
}

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //echo 'Conexao efetuada com sucesso!';
}
catch(PDOException $e){
    $erro = $e->getMessage();
}					
?>