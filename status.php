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
					

					$sql = "DELETE FROM status WHERE idStatus =  :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
					$stmt->execute();		

					echo "<script>location.href='listar_status.php?status=Deletado com sucesso!';</script>";

					
				} catch (PDOException $e) {	
				
					$erro = $e->getMessage();	
				}	
					
			exit();	
			
		}		
		
		
		
		if(isset($_POST['acao']) && $_POST['acao'] == "editar"){ 
		
		



			if(empty($_POST['nome'])){
				$erro = "Informe um status.";
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
						
						

							
						$idStatus = filter_var($_POST['idStatus']);
						$nome = filter_var($_POST['nome']);
						
						
						
					
						$sql = "
						
						UPDATE status SET
							idStatus = :idStatus,
							nome = :nome
						WHERE idStatus = :idStatus
						
						";
						
	
						
						
						$stmt = $pdo->prepare($sql);			
						$stmt->bindParam(':idStatus', $idStatus, PDO::PARAM_INT);		
						$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);		
						$ress = $stmt->execute();
		
								if($ress){	
									$status = 1;	
									$erro = "Status alterado com sucesso";
								}else{
									$status = 0;					
									$erro = "Erro ao alterar status";
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


	if($_POST['nome'] == ""){
		$erro = 'Informe um status.';
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
			
			$nome = filter_var($_POST['nome']);

			$sql = "INSERT INTO status (nome) VALUES (:nome)";			
				$insert = $pdo->prepare($sql);			
				$insert->bindParam(':nome', $nome);
				$ress = $insert->execute();
				$lastIdStatus = $pdo->lastInsertId();	

				if($ress){	
					$status = 1;	
					$erro = "Status cadastrado com sucesso";
				}else{
					$status = 0;					
					$erro = "Erro ao cadastrar Status";
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