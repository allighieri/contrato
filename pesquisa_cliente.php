<?php
	include_once 'conn.php';			
	date_default_timezone_set('America/Sao_Paulo');	
	@header("Content-Type: text/html; charset=iso-utf-8");	
	@header("Cache-Control: no-cache, must-revalidate");	
	@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	@header('Access-Control-Allow-Origin: *');	
	
	// Cria uma variável que terá os dados do erro	
	$erro = false;	
	
	// Verifica se o POST tem algum valor	
	if ( !isset( $_POST ) || empty( $_POST ) ) {		
		$erro = 'Nada foi postado.';	
	}	// Cria as variáveis dinamicamente	
		
	foreach ( $_POST as $chave => $valor ) {		
		// Remove todas as tags HTML		
		// Remove os espaços em branco do valor		
		$$chave = trim(strip_tags($valor));

		$valor = trim(strip_tags($valor));		
		
		// Verifica se tem algum valor nulo		
		if ( empty ( $valor ) ) {			
			$erro = 'Existem campos em branco.';		
		}	
	}
	
	
	// Se existir algum erro, mostra o erro	
	if ( $erro ) {	
		$erro;
		$retorno = array('erro'=>$erro);
		echo json_encode($retorno, JSON_PRETTY_PRINT);		
	} else {
		
		//verifica se já há um cliente cadastrado com CPF
		
		
		
		
		
		
		
		
		
		
		
		//$sql= "SELECT * FROM cpf_cnpj WHERE cpf_cnpj = :cpf_cnpj";	
		
		$sql= "SELECT 
			c.idCliente, 
			c.idCpfCnpj, 
			c.nome, 
			c.telefone, 
			c.endereco, 
			c.email, 
			cp.idCpfCnpj, 
			cp.cpf_cnpj, 
			cp.data 
			FROM cliente as c INNER JOIN cpf_cnpj as cp 
			on c.idCpfCnpj = cp.idCpfCnpj 
			WHERE cp.cpf_cnpj = :cpf_cnpj";	
		$stmt = $pdo->prepare($sql);	
		$stmt->bindParam(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$user = $stmt->fetch();	
		
		if($total > 0){		
			$erro = "Cliente encontrado.";
			$status = 1;
			
			$nome = 		$user['nome'];
			$telefone = 	$user['telefone'];
			$endereco = 	$user['endereco']; 
			$email = 		$user['email'];
			$cpf_cnpj = 	$user['cpf_cnpj']; 
			$data = 		$user['data']; 
			
			
			$retorno = array('erro'=>$erro, 'status'=>$status, 'nome'=>$nome, 'telefone'=>$telefone, 'endereco'=>$endereco, 'email'=>$email, 'cpf_cnpj'=>$cpf_cnpj, 'data'=>$data);										
			echo json_encode($retorno, JSON_PRETTY_PRINT);
			
		}else{
			$status = 0;
			$erro = "Não há dados de cliente para este CPF/CNPJ";
			$retorno = array('erro'=>$erro, 'status'=>$status);										
			echo json_encode($retorno, JSON_PRETTY_PRINT);
		}	
		

							
	}	

?>