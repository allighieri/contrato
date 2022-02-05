<?php
	include_once 'conn.php';			
	date_default_timezone_set('America/Sao_Paulo');	
	@header("Content-Type: text/html; charset=iso-utf-8");	
	@header("Cache-Control: no-cache, must-revalidate");	
	@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	@header('Access-Control-Allow-Origin: *');	
	
	// Cria uma variável que terá os dados do erro	
	$erro = false;	
	

	
	// Verifica se o POST tem algum valor ou se o GET tem valor	
		
		if(isset($_GET['acao']) && $_GET['acao'] == "deletar"){ 
					try {
					

					$sql = "DELETE FROM cpf_cnpj WHERE idCpfCnpj =  :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
					$stmt->execute();		

					echo "<script>location.href='listar_clientes.php?status=Deletado com sucesso!';</script>";

					
				} catch (PDOException $e) {	
				
					$erro = $e->getMessage();	
				}	
					
			exit();	
			
		}		
		
		
		
		if(isset($_POST['acao']) && $_POST['acao'] == "editar"){ 
		
		
		
		
		
			//ALTERA NO BANCO DE DADOS
			// Cria as variáveis dinamicamente	
				
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
				

				$sql= 
				"
					SELECT 
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
				
					if (in_array($cpf_cnpj, $clientesArray)) { 
						
						
						
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
											on c.idCpfCnpj = cp.idCpfCnpj 
											WHERE cp.cpf_cnpj = :cpf_cnpj";	
										$stmt = $pdo->prepare($sql);	
										$stmt->bindParam(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);	
										$stmt->execute();	
										$total = $stmt->rowCount();	
										$cliente = $stmt->fetch();
										
										if($cpf_cnpj != in_array($cpf_cnpj, $clientesArray) || $cpf_cnpj == $cliente['cpf_cnpj']){
											



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
														
													isset($email) ? $email = trim($email) : "" ;	


													// Verifica se $email realmente existe e se é um email. 	
													// Também verifica se não existe nenhum erro anterior	
													if ( ( ! isset( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) && !$erro ) {		
														$erro = 'Envie um email válido.';	
													}			
													
													

													// Se existir algum erro, mostra o erro	
													if ( $erro ) {	
														$erro;
														$status = 0;
														$retorno = array('erro'=>$erro, 'status'=>$status);										
														echo json_encode($retorno, JSON_PRETTY_PRINT);			
													} else {
														
													
														// Se a variável $erro continuar com valor falso				
														try {
															$cpf_cnpj = filter_var(mb_strtoupper($_POST['cpf_cnpj'],'utf-8'));
															$nome = filter_var(mb_strtoupper($_POST['nome'],'utf-8'));
															$telefone = filter_var(mb_strtoupper($_POST['telefone'],'utf-8'));
															$cep = filter_var(mb_strtoupper($_POST['cep'],'utf-8'));
															$endereco = filter_var(mb_strtoupper($_POST['endereco'],'utf-8'));
															$bairro = filter_var(mb_strtoupper($_POST['bairro'],'utf-8'));
															$cidade = filter_var(mb_strtoupper($_POST['cidade'],'utf-8'));
															$uf = filter_var(mb_strtoupper($_POST['uf'],'utf-8'));
															$email = filter_var(mb_strtolower($_POST['email'],'utf-8'));
															$data = filter_var(mb_strtolower($_POST['dataCPF'],'utf-8'));
																			

															$pdo->beginTransaction();/* Inicia a transação */  			
															$sql = "UPDATE cpf_cnpj SET 
																		cpf_cnpj = :cpf_cnpj, 
																		data = :data
																		WHERE idCpfCnpj = :idCpfCnpj";
															$stmt = $pdo->prepare($sql);                                  
															$stmt->bindParam(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);       
															$stmt->bindParam(':data', $data, PDO::PARAM_STR);    
															$stmt->bindParam(':idCpfCnpj', $idCpfCnpj, PDO::PARAM_INT);   
															$ress = $stmt->execute(); 
															
															



															
															
															if($ress){	
																$status = 1;	
																$erro = "CPF cadastrado com sucesso: ".$idCpfCnpj;
																
																
																	
															$sql = "
															
															UPDATE cliente SET 
																idCliente = :idCliente,
																idCpfCnpj = :idCpfCnpj, 
																nome = :nome,
																telefone = :telefone,
																cep = :cep,
																endereco = :endereco,
																bairro =:bairro,
																cidade = :cidade,
																uf = :uf,
																email = :email
															WHERE idCliente = :idCliente
															
															";
															
															
															$stmt = $pdo->prepare($sql);                                  
															$stmt->bindParam(':idCliente', $idCpfCnpj, PDO::PARAM_INT);   
															$stmt->bindParam(':idCpfCnpj', $idCpfCnpj, PDO::PARAM_INT);   
															$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);       
															$stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);    
															$stmt->bindParam(':cep', $cep, PDO::PARAM_STR);    
															$stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);    
															$stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
															$stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);    
															$stmt->bindParam(':uf', $uf, PDO::PARAM_STR);    
															$stmt->bindParam(':email', $email, PDO::PARAM_STR);    
															$ress = $stmt->execute(); 


																	
													

																	if($ress){	
																		$pdo->commit();
																		$status = 1;	
																		$erro = "Cliente cadastrado com sucesso";
																	}else{
																		$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
																		$status = 0;					
																		$erro = "Erro ao cadastrar cliente ";
																		return false;	
																	}				
																
															}else{	
																$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
																$status = 0;					
																$erro = "Houve um erro ao enviar seus dados. ".$email ;				
																return false;
															}										

															$retorno = array('erro'=>$erro, 'status'=>$status);										
															echo json_encode($retorno, JSON_PRETTY_PRINT);						
																
															//header('location: index.php');
															
														} catch (PDOException $e) {						
																$status = 0;			
																$erro = $e->getMessage();			
																$retorno = array('erro'=>$erro, 'status'=>$status);			
																echo json_encode($retorno, JSON_PRETTY_PRINT);					
															}			
													}























											
										}else{
											
														$status = 1;
														$erro = "CPF ".$cpf_cnpj. " NÃO pode ser alterado";
														$retorno = array('erro'=>$erro, 'status'=>$status, 'cpf_cnpj'=>$cpf_cnpj);
														echo json_encode($retorno, JSON_PRETTY_PRINT);
														
											
										}
						
						
					}else{

										




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
														
													isset($email) ? $email = trim($email) : "" ;	


													// Verifica se $email realmente existe e se é um email. 	
													// Também verifica se não existe nenhum erro anterior	
													if ( ( ! isset( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) && !$erro ) {		
														$erro = 'Envie um email válido.';	
													}			
													
													

													// Se existir algum erro, mostra o erro	
													if ( $erro ) {	
														$erro;
														$status = 0;
														$retorno = array('erro'=>$erro, 'status'=>$status);										
														echo json_encode($retorno, JSON_PRETTY_PRINT);			
													} else {
														
													
														// Se a variável $erro continuar com valor falso				
														try {
															$cpf_cnpj = filter_var(mb_strtoupper($_POST['cpf_cnpj'],'utf-8'));
															$nome = filter_var(mb_strtoupper($_POST['nome'],'utf-8'));
															$telefone = filter_var(mb_strtoupper($_POST['telefone'],'utf-8'));
															$cep = filter_var(mb_strtoupper($_POST['cep'],'utf-8'));
															$endereco = filter_var(mb_strtoupper($_POST['endereco'],'utf-8'));
															$bairro = filter_var(mb_strtoupper($_POST['bairro'],'utf-8'));
															$cidade = filter_var(mb_strtoupper($_POST['cidade'],'utf-8'));
															$uf = filter_var(mb_strtoupper($_POST['uf'],'utf-8'));
															$email = filter_var(mb_strtolower($_POST['email'],'utf-8'));
															$data = filter_var(mb_strtolower($_POST['dataCPF'],'utf-8'));				

															$pdo->beginTransaction();/* Inicia a transação */  			
															$sql = "UPDATE cpf_cnpj SET 
																		cpf_cnpj = :cpf_cnpj, 
																		data = :data
																		WHERE idCpfCnpj = :idCpfCnpj";
															$stmt = $pdo->prepare($sql);                                  
															$stmt->bindParam(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);       
															$stmt->bindParam(':data', $data, PDO::PARAM_STR);    
															$stmt->bindParam(':idCpfCnpj', $idCpfCnpj, PDO::PARAM_INT);   
															$ress = $stmt->execute(); 
															
															



															
															
															if($ress){	
																$status = 1;	
																$erro = "CPF cadastrado com sucesso: ".$idCpfCnpj;
																
																
																	
															$sql = "
															
															UPDATE cliente SET 
															idCliente = :idCliente,
															idCpfCnpj = :idCpfCnpj, 
															nome = :nome,
															telefone = :telefone,
															cep = :cep,
															endereco = :endereco,
															bairro = :bairro,
															cidade = :cidade,
															uf = :uf,
															email = :email
															WHERE idCliente = :idCliente
															
															";
															
															
															$stmt = $pdo->prepare($sql);                                  
															$stmt->bindParam(':idCliente', $idCpfCnpj, PDO::PARAM_INT);   
															$stmt->bindParam(':idCpfCnpj', $idCpfCnpj, PDO::PARAM_INT);   
															$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);       
															$stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);    
															$stmt->bindParam(':cep', $cep, PDO::PARAM_STR);    
															$stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);    
															$stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);    
															$stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);    
															$stmt->bindParam(':uf', $uf, PDO::PARAM_STR);    
															$stmt->bindParam(':email', $email, PDO::PARAM_STR);    
															$ress = $stmt->execute(); 


																	
													

																	if($ress){	
																		$pdo->commit();
																		$status = 1;	
																		$erro = "Cliente cadastrado com sucesso";
																	}else{
																		$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
																		$status = 0;					
																		$erro = "Erro ao cadastrar cliente ";
																		return false;	
																	}				
																
															}else{	
																$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
																$status = 0;					
																$erro = "Houve um erro ao enviar seus dados. ".$email ;				
																return false;
															}										

															$retorno = array('erro'=>$erro, 'status'=>$status);										
															echo json_encode($retorno, JSON_PRETTY_PRINT);						
																
															//header('location: index.php');
															
														} catch (PDOException $e) {						
																$status = 0;			
																$erro = $e->getMessage();			
																$retorno = array('erro'=>$erro, 'status'=>$status);			
																echo json_encode($retorno, JSON_PRETTY_PRINT);					
															}			
													}

















					}					




			
			
			
			
			
			
			
			
					
			exit();	
			
		}


	
	//INSERE NOVO NO BANCO DE DADOS
	// Cria as variáveis dinamicamente	
		
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
		
	isset($email) ? $email = trim($email) : "" ;	
		
	// verifica se já há um cliente cadastrado com CPF
	$sql= "SELECT * FROM cpf_cnpj WHERE cpf_cnpj = :cpf_cnpj";	
	$stmt = $pdo->prepare($sql);	
	$stmt->bindParam(':cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);	
	$stmt->execute();	
	$total = $stmt->rowCount();			
	
	if($total > 0){		
		$erro = "Você já possui um cadastro com esse CPF cara";	
	}	

	// Verifica se $email realmente existe e se é um email. 	
	// Também verifica se não existe nenhum erro anterior	
	if ( ( ! isset( $email ) || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) && !$erro ) {		
		$erro = 'Envie um email válido.';	
	}			
	
	

	// Se existir algum erro, mostra o erro	
	if ( $erro ) {	
		$erro;
		$status = 0;
		$retorno = array('erro'=>$erro, 'status'=>$status);										
		echo json_encode($retorno, JSON_PRETTY_PRINT);			
	} else {
		
	
		// Se a variável $erro continuar com valor falso				
		try {
			$cpf_cnpj = filter_var(mb_strtoupper($_POST['cpf_cnpj'],'utf-8'));
			$nome = filter_var(mb_strtoupper($_POST['nome'],'utf-8'));
			$telefone = filter_var(mb_strtoupper($_POST['telefone'],'utf-8'));
			$cep = filter_var(mb_strtoupper($_POST['cep'],'utf-8'));
			$endereco = filter_var(mb_strtoupper($_POST['endereco'],'utf-8'));
			$bairro = filter_var(mb_strtoupper($_POST['bairro'],'utf-8'));
			$cidade = filter_var(mb_strtoupper($_POST['cidade'],'utf-8'));
			$uf = filter_var(mb_strtoupper($_POST['uf'],'utf-8'));
			$email = filter_var(mb_strtolower($_POST['email'],'utf-8'));
			$data = date('Y-m-d H:i:s');				

			$pdo->beginTransaction();/* Inicia a transação */  			
			$sql = "INSERT INTO cpf_cnpj (cpf_cnpj, data) VALUES (:cpf_cnpj, :data)";			
			$insert = $pdo->prepare($sql);			
			$insert->bindParam(':cpf_cnpj', $cpf_cnpj);		
			$insert->bindParam(':data', $data);				
			$ress = $insert->execute();
			$lastIdCpf = $pdo->lastInsertId();		
			



			
			
			if($ress){	
				$status = 1;	
				$erro = "CPF cadastrado com sucesso: ".$lastIdCpf;
				
				
				$sql = "INSERT INTO cliente (idCpfCnpj, nome, telefone, cep, endereco, bairro, cidade, uf, email ) VALUES (:idCpfCnpj, :nome, :telefone, :cep, :endereco, :bairro, :cidade, :uf, :email)";			
					$insert = $pdo->prepare($sql);			
					$insert->bindParam(':idCpfCnpj', $lastIdCpf);		
					$insert->bindParam(':nome', $nome);		
					$insert->bindParam(':telefone', $telefone);		
					$insert->bindParam(':cep', $cep);		
					$insert->bindParam(':endereco', $endereco);		
					$insert->bindParam(':bairro', $bairro);		
					$insert->bindParam(':cidade', $cidade);		
					$insert->bindParam(':uf', $uf);		
					$insert->bindParam(':email', $email);		
					$ress = $insert->execute();
					$lastIdCliente = $pdo->lastInsertId();		
	

					if($ress){	
						$pdo->commit();
						$status = 1;	
						$erro = "Cliente cadastrado com sucesso";
					}else{
						$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
						$status = 0;					
						$erro = "Erro ao cadastrar cliente ";
						return false;	
					}				
				
			}else{	
				$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
				$status = 0;					
				$erro = "Houve um erro ao enviar seus dados. ".$email ;				
				return false;
			}										

			$retorno = array('erro'=>$erro, 'status'=>$status);										
			echo json_encode($retorno, JSON_PRETTY_PRINT);						
				
			//header('location: index.php');
			
		} catch (PDOException $e) {						
				$status = 0;			
				$erro = $e->getMessage();			
				$retorno = array('erro'=>$erro, 'status'=>$status);			
				echo json_encode($retorno, JSON_PRETTY_PRINT);					
			}			
	}