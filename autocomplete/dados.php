<?php
require_once('../conn.php');

$sql= "SELECT 
		c.idCliente, 
		c.idCpfCnpj, 
		c.nome, 
		c.telefone,
		c.endereco, 
		c.bairro,
		c.cidade,
		c.uf,		
		c.email, 
		cp.idCpfCnpj, 
		cp.cpf_cnpj, 
		cp.data 
		FROM cliente as c INNER JOIN cpf_cnpj as cp 
		on c.idCpfCnpj = cp.idCpfCnpj";	
	$stmt = $pdo->prepare($sql);	
	//$stmt->bindParam(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);	
	$stmt->execute();	
	$total = $stmt->rowCount();	
	$cliente = $stmt->fetchAll();
	
header('Content-Type: application/json; charset=utf-8');
echo json_encode($cliente, JSON_PRETTY_PRINT);

