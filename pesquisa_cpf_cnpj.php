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
		

		



		if(isset($_POST['idCpfCnpj'])){
			
			$sql= 
			"
				SELECT 
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
			";	
			$stmt = $pdo->prepare($sql);	
			$stmt->execute();	
			$total = $stmt->rowCount();	
			$cliente = $stmt->fetchAll();
			
			$clientesArray = array();
			
			foreach($cliente as $cliente){
				
				array_push($clientesArray,$cliente['cpf_cnpj']);
				
			}
			
			
			
			
			
			$txt_cpf_cnpj = $_POST['cpf_cnpj'];
			$txt_idCpfCnpj = $_POST['idCpfCnpj'];
			
			
			
			
			
			if (in_array($txt_cpf_cnpj, $clientesArray)) { 
				
				
				
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
								$stmt->bindParam(':cpf_cnpj', $txt_cpf_cnpj, PDO::PARAM_STR);	
								$stmt->execute();	
								$total = $stmt->rowCount();	
								$cliente = $stmt->fetch();
								
								if($txt_cpf_cnpj != in_array($txt_cpf_cnpj, $clientesArray) || $valueCPF == $cliente['cpf_cnpj']){
									
												$status = 0;
												$erro = "CPF ".$txt_cpf_cnpj. " pode ser alterado";
												$retorno = array('erro'=>$erro, 'status'=>$status, 'cpf_cnpj'=>$txt_cpf_cnpj);
												echo json_encode($retorno, JSON_PRETTY_PRINT);
									
								}else{
									
												$status = 1;
												$erro = "CPF ".$txt_cpf_cnpj. " não pode ser alterado";
												$retorno = array('erro'=>$erro, 'status'=>$status, 'cpf_cnpj'=>$txt_cpf_cnpj);
												echo json_encode($retorno, JSON_PRETTY_PRINT);
									
								}
				
				
			}else{
												$status = 0;
												$erro = "CPF ".$txt_cpf_cnpj. " pode ser alterado";
												$retorno = array('erro'=>$erro, 'status'=>$status, 'cpf_cnpj'=>$txt_cpf_cnpj);
												echo json_encode($retorno, JSON_PRETTY_PRINT);
			}			
			
			
			

			
			
			
			
		}else{








					//Se não for, continua com as verificações para saber se existe no banco de dados
		
					
					//verifica se já há um cliente cadastrado com CPF
					
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
					$cliente = $stmt->fetch();			
	
					if($cliente > 0){	
					
						$status = 1;
						$erro = "Ops, parece que este CPF já existe";
						$cpf_cnpj = 	$_POST['cpf_cnpj']; 
						$retorno = array('erro'=>$erro, 'status'=>$status, 'cpf_cnpj'=>$cpf_cnpj);
						echo json_encode($retorno, JSON_PRETTY_PRINT);
						
					}else{
						$status = 0;
						$erro = "Sem dados de cliente para este CPF/CNPJ, certo";
						$cpf_cnpj = 	$_POST['cpf_cnpj']; 
						$retorno = array('erro'=>$erro, 'status'=>$status, 'cpf_cnpj'=>$cpf_cnpj);
						echo json_encode($retorno, JSON_PRETTY_PRINT);
					}
				

		
			
		}					
	}	

?>