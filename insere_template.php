<?php
	include_once 'conn.php';			
	date_default_timezone_set('America/Sao_Paulo');	
	@header("Content-Type: text/html; charset=iso-utf-8");	
	@header("Cache-Control: no-cache, must-revalidate");	
	@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	@header('Access-Control-Allow-Origin: *');	
	
	
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
		
				
		try {
			$template = filter_var($_POST['texto'],'utf-8');

			$data = date('Y-m-d H:i:s');				

			$sql = "INSERT INTO template (template, data) VALUES (:template, :data)";			
			$insert = $pdo->prepare($sql);			
			$insert->bindParam(':template', $template);		
			$insert->bindParam(':data', $data);		
			$pdo->beginTransaction();
			$ress = $insert->execute();
			$lastIdCpf = $pdo->lastInsertId();
			$pdo->commit();							

			
		} catch (PDOException $e) {						
				$status = 0;			
				$erro = $e->getMessage();			
				$retorno = array('erro'=>$erro, 'status'=>$status);			
				echo json_encode($retorno, JSON_PRETTY_PRINT);					
			}			


?>