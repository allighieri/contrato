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
					

					$sql = "DELETE FROM eventos WHERE idEventos =  :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
					$stmt->execute();		

					echo "<script>location.href='listar_eventos.php?status=Deletado com sucesso!';</script>";

					
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
					
						
					
					

				// Se existir algum erro, mostra o erro	
				if ( $erro ) {	
					$erro;
					$status = 0;
					$retorno = array('erro'=>$erro, 'status'=>$status);										
					echo json_encode($retorno, JSON_PRETTY_PRINT);			
				} else {
					
				
					// Se a variável $erro continuar com valor falso				
					try {
						
							
						
						
						$idEventos = filter_var(mb_strtoupper($_POST['idEventos'],'utf-8'));
						
				
						
						
						$idCliente = filter_var(mb_strtoupper($_POST['idCliente'],'utf-8'));
						$endereco = filter_var(mb_strtoupper($_POST['endereco'],'utf-8'));
						$cep = filter_var(mb_strtoupper($_POST['cep'],'utf-8'));
						$bairro = filter_var(mb_strtoupper($_POST['bairro'],'utf-8'));
						$cidade = filter_var(mb_strtoupper($_POST['cidade'],'utf-8'));
						$uf = filter_var(mb_strtoupper($_POST['uf'],'utf-8'));
						$instalacao = filter_var(mb_strtoupper($_POST['instalacao'],'utf-8'));
						$horainstalacao = filter_var(mb_strtoupper($_POST['horainstalacao'],'utf-8'));
						$retirada = filter_var(mb_strtoupper($_POST['retirada'],'utf-8'));
						$horaretirada = filter_var(mb_strtoupper($_POST['horaretirada'],'utf-8'));
						$idStatus = filter_var(mb_strtoupper($_POST['idStatus'],'utf-8'));
	
						$instalacao = $instalacao." ".$horainstalacao.":00";
						$retirada = $retirada." ".$horaretirada.":00";
						
						$sql = "
						
						UPDATE eventos SET
							idEventos = :idEventos,
							idCliente = :idCliente,
							endereco = :endereco, 
							cep = :cep,
							bairro = :bairro,
							cidade = :cidade,
							uf = :uf,
							instalacao =:instalacao,
							retirada = :retirada,
							idStatus = :idStatus
						WHERE idEventos = :idEventos
						
						";
						
						
						$stmt = $pdo->prepare($sql);			
						$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);		
						$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);		
						$stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);		
						$stmt->bindParam(':cep', $cep, PDO::PARAM_STR);		
						$stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);		
						$stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);		
						$stmt->bindParam(':uf', $uf, PDO::PARAM_STR);		
						$stmt->bindParam(':instalacao', $instalacao, PDO::PARAM_STR);		
						$stmt->bindParam(':retirada', $retirada, PDO::PARAM_STR);		
						$stmt->bindParam(':idStatus', $idStatus, PDO::PARAM_INT);		
						$ress = $stmt->execute();
		
						
						
						
						
					
						
								if($ress){	
									$status = 1;	
									$erro = "evento alterado com sucesso";
								}else{
									$status = 0;					
									$erro = "Erro ao alterar evento ";
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
		
	
	// Se existir algum erro, mostra o erro	
	if ( $erro ) {	
		$erro;
		$status = 0;
		$retorno = array('erro'=>$erro, 'status'=>$status);										
		echo json_encode($retorno, JSON_PRETTY_PRINT);			
	} else {
		

		
		
	
		// Se a variável $erro continuar com valor falso				
		try {
			

			
			
			$idCliente = filter_var(mb_strtoupper($_POST['idCliente'],'utf-8'));
			$endereco = filter_var(mb_strtoupper($_POST['endereco'],'utf-8'));
			$cep = filter_var(mb_strtoupper($_POST['cep'],'utf-8'));
			$bairro = filter_var(mb_strtoupper($_POST['bairro'],'utf-8'));
			$cidade = filter_var(mb_strtoupper($_POST['cidade'],'utf-8'));
			$uf = filter_var(mb_strtoupper($_POST['uf'],'utf-8'));
			$instalacao = filter_var(mb_strtoupper($_POST['instalacao'],'utf-8'));
			$horainstalacao = filter_var(mb_strtoupper($_POST['horainstalacao'],'utf-8'));
			$retirada = filter_var(mb_strtoupper($_POST['retirada'],'utf-8'));
			$horaretirada = filter_var(mb_strtoupper($_POST['horaretirada'],'utf-8'));
			$idStatus = filter_var(mb_strtoupper($_POST['idStatus'],'utf-8'));

			$instalacao = $instalacao." ".$horainstalacao.":00";
			$retirada = $retirada." ".$horaretirada.":00";

	
			$sql = "INSERT INTO eventos (idCliente, endereco, cep, bairro, cidade, uf, instalacao, retirada, idStatus) VALUES (:idCliente, :endereco, :cep, :bairro, :cidade, :uf, :instalacao, :retirada, :idStatus)";			
				$insert = $pdo->prepare($sql);			
				$insert->bindParam(':idCliente', $idCliente);		
				$insert->bindParam(':endereco', $endereco);		
				$insert->bindParam(':cep', $cep);		
				$insert->bindParam(':bairro', $bairro);		
				$insert->bindParam(':cidade', $cidade);		
				$insert->bindParam(':uf', $uf);		
				$insert->bindParam(':instalacao', $instalacao);		
				$insert->bindParam(':retirada', $retirada);		
				$insert->bindParam(':idStatus', $idStatus);		
				$ress = $insert->execute();
				$lastIdCliente = $pdo->lastInsertId();	


				


				if($ress){	
					$status = 1;	
					$erro = "Evento cadastrado com sucesso";
				}else{
					$status = 0;					
					$erro = "Erro ao cadastrar evento ";
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