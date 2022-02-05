<?php
	include_once '../../conn.php';			
	date_default_timezone_set('America/Sao_Paulo');	
	@header("Content-Type: text/html; charset=iso-utf-8");	
	@header("Cache-Control: no-cache, must-revalidate");	
	@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	@header('Access-Control-Allow-Origin: *');	
	
	$erro = false;	

	
		try {
			
			
			$idEventos = filter_var(mb_strtoupper($_POST['idEventos'],'utf-8'));
			$idAparelhos = filter_var(mb_strtoupper($_POST['idAparelhos'],'utf-8'));
			$valorDiaria = filter_var(mb_strtoupper($_POST['valorDiaria'],'utf-8'));
			

			//$pdo->beginTransaction();/* Inicia a transação */  			
			$sql = "INSERT INTO aparelhos_contrato (idAparelhos, idEventos, valorDiaria) VALUES (:idAparelhos, :idEventos, :valorDiaria)";			
			$insert = $pdo->prepare($sql);			
			$insert->bindParam(':idAparelhos', $idAparelhos);		
			$insert->bindParam(':idEventos', $idEventos);				
			$insert->bindParam(':valorDiaria', $valorDiaria);				
			$ress = $insert->execute();
			$lastIdAparelhosContrato = $pdo->lastInsertId();
			
			
			if($ress){	
			
				$idItens = $_POST['itens']; // array
				$qtde = $_POST['qtde']; // array
				$count = count($idItens);
				
				$sql= "SELECT * FROM itens_contrato WHERE idEventos = :idEventos";
					$stmt = $pdo->prepare($sql);	
					$stmt->bindParam(':idEventos', $idEventos);
					$stmt->execute();	
					$totalEventos = $stmt->rowCount();	
					
					if($totalEventos > 0){ // se existir idEventos procura se existe idItens
						
						for ($i=0;$i<$count;$i++){
							
							$sql= "SELECT * FROM itens_contrato WHERE idItens = :idItens";
								$stmt = $pdo->prepare($sql);	
								$stmt->bindParam(':idItens', $idItens[$i]);
								$stmt->execute();	
								$totalIdItens = $stmt->rowCount();	


								if($totalIdItens > 0 ){ // se existir itens para esse evento, não deixa cadastrar
											
									echo "Erro, estes itens existem. <br />";
											
								}else{
									
									
									$sql = "INSERT INTO itens_contrato (idItens, idEventos, qtde) VALUES (:idItens, :idEventos, :qtde)";			
										$insert = $pdo->prepare($sql);			
										$insert->bindParam(':idItens', $idItens[$i]);		
										$insert->bindParam(':idEventos', $idEventos);		
										$insert->bindParam(':qtde', $qtde[$i]);				
										$ress = $insert->execute();
										$lastIdCliente = $pdo->lastInsertId();		
						

										if($ress){	
											//$pdo->commit();
											$status = 1;	
											$erro = "Itens cadastrados com sucesso";
										}else{
											//$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
											$status = 0;					
											$erro = "Erro ao cadastrar itens";
											return false;	
										}									

								}
						
						} // fim do primeiro for

						
					}else{ // Se não tiver idEventos cadastrado pode cadastrar todos os itens selecionados

						for ($i=0;$i<$count;$i++){

							$sql = "INSERT INTO itens_contrato (idItens, idEventos, qtde) VALUES (:idItens, :idEventos, :qtde)";			
								$insert = $pdo->prepare($sql);			
								$insert->bindParam(':idItens', $idItens[$i]);		
								$insert->bindParam(':idEventos', $idEventos);		
								$insert->bindParam(':qtde', $qtde[$i]);				
								$ress = $insert->execute();
								$lastIdCliente = $pdo->lastInsertId();		
				

								if($ress){	
									//$pdo->commit();
									$status = 1;	
									$erro = "Itens cadastrados com sucesso";
								}else{
									//$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
									$status = 0;					
									$erro = "Erro ao cadastrar itens";
									return false;	
								}
						}
						
					}	
				
			}else{	// Fim do se cadastrado aparelhos ao evento


			}										


			
		} catch (PDOException $e) {	 // fim do Try para transações com o banco de dados em inserção					
			
				$erro = $e->getMessage();			
					
			}			
