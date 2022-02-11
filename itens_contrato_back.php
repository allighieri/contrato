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
					

					$sql = "DELETE FROM itens_contrato WHERE idItensContrato =  :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':idItensContrato', $_GET['id'], PDO::PARAM_INT);   
					$stmt->execute();		

					echo "<script>location.href='listar_itens.php?status=Deletado com sucesso!';</script>";

					
				} catch (PDOException $e) {	
				
					$erro = $e->getMessage();	
				}	
					
			exit();	
			
		}		
		
		
		
		if(isset($_POST['acao']) && $_POST['acao'] == "editar"){ 
		
		



			if(empty($_POST['descricao'])){
				$erro = "Informe a descrição de um item";
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
						
							
						
						$idItens = filter_var($_POST['idItens']);
						$descricao = filter_var($_POST['descricao']);
						$padrao = filter_var($_POST['padrao']);
						
						$sql = "
						
						UPDATE itens SET
							idItens = :idItens,
							descricao = :descricao,
							padrao = :padrao
						WHERE idItens = :idItens
						
						";
						
						
						$stmt = $pdo->prepare($sql);			
						$stmt->bindParam(':idItens', $idItens, PDO::PARAM_INT);		
						$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);		
						$stmt->bindParam(':padrao', $padrao, PDO::PARAM_INT);		
						$ress = $stmt->execute();
		
								if($ress){	
									$status = 1;	
									$erro = "Item alterado com sucesso";
								}else{
									$status = 0;					
									$erro = "Erro ao alterar item ";
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
				}//se não tiver erro




			
			
				
			
			exit();	
			
		}//altera cadastro

	
	//INSERE NOVO NO BANCO DE DADOS
	
	
	
	// Se existir algum erro, mostra o erro	
	if ( $erro ) {	
		$erro;
		$status = 0;
		$retorno = array('erro'=>$erro, 'status'=>$status);										
		echo json_encode($retorno, JSON_PRETTY_PRINT);			
	} else {
		


	
		try {
			
			
			$idEventos = filter_var(mb_strtoupper($_POST['idEventos'],'utf-8'));
			$idAparelhos = filter_var(mb_strtoupper($_POST['idAparelhos'],'utf-8'));
			$valorDiaria = filter_var(mb_strtoupper($_POST['valorDiaria'],'utf-8'));
			
			
			$sql = "INSERT INTO aparelhos_contrato (idAparelhos, idEventos, valorDiaria) VALUES (:idAparelhos, :idEventos, :valorDiaria)";			
			$insert = $pdo->prepare($sql);			
			$insert->bindParam(':idAparelhos', $idAparelhos);		
			$insert->bindParam(':idEventos', $idEventos);				
			$insert->bindParam(':valorDiaria', $valorDiaria);				
			$ress = $insert->execute();
			$lastIdAparelhosContrato = $pdo->lastInsertId();	

			
			if($ress){	
			
				$idItens = $_POST['idItens']; // array
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


								if($totalIdItens == 0 ){ // se existir itens para esse evento, não deixa cadastrar
														
									
									$sql = "INSERT INTO itens_contrato (idItens, idEventos, qtde) VALUES (:idItens, :idEventos, :qtde)";			
										$insert = $pdo->prepare($sql);			
										$insert->bindParam(':idItens', $idItens[$i]);		
										$insert->bindParam(':idEventos', $idEventos);		
										$insert->bindParam(':qtde', $qtde[$i]);				
										$ress = $insert->execute();
										$lastIdCliente = $pdo->lastInsertId();		
						

										if($ress){	
											//$pdo->commit();
											
											$erro = ($count > 1) ? "Itens cadastrados com sucesso" : "Item cadastrado com sucesso";
											$status = 1;	

										}else{
											//$pdo->rollBack(); /* Desfaz a inserção na tabela de movimentos em caso de erro na query da tabela conta */
											$status = 0;					
											$erro = "Erro ao cadastrar itens";
											return false;	
										}										

											
								}else{ // se não tiver item já cadastrado, cadastra os novos
									
									
									$status = 1;			
									$erro = "Parece que um ou mais itens já foram adicionados a este evento. Eles não serão duplicados. Os novos itens serão adicionado normalmente. Caso queira mudar a quantidade de um item já inserido, utilize o formulário de edição de Itens do Contrato";			
					

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

				$status = 0;					
				$erro = "Erro ao cadastrar aparelho";
				return false;

			}										

			$retorno = array('erro'=>$erro, 'status'=>$status);										
			echo json_encode($retorno, JSON_PRETTY_PRINT);	
			
		
		} catch (PDOException $e) {						
				$status = 0;			
				$erro = $e->getMessage();			
				$retorno = array('erro'=>$erro, 'status'=>$status);			
				echo json_encode($retorno, JSON_PRETTY_PRINT);					
			}			
	}