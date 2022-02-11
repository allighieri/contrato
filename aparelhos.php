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
					

					$sql = "DELETE FROM aparelhos WHERE idAparelhos =  :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
					$stmt->execute();		

					echo "<script>location.href='listar_aparelhos.php?status=Deletado com sucesso!';</script>";

					
				} catch (PDOException $e) {	
				
					$erro = $e->getMessage();	
				}	
					
			exit();	
			
		}		
		
		
		
		if(isset($_POST['acao']) && $_POST['acao'] == "editar"){ 
		
		



			if(empty($_POST['nome'])){
				$erro = "Informe o nome do videokê.";
			}

			if(empty($_POST['modelo'])){
				$erro = "Informe o modelo do videokê.";
			}

			if(empty($_POST['serial'])){
				$erro = "Informe o serial do videokê.";
			}

			if(empty($_POST['musicas'])){
				$erro = "Informe quantidade de músicas do videokê.";
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
						
							
						
						$idAparelhos = filter_var(mb_strtoupper($_POST['idAparelhos'],'utf-8'));
						$nome = filter_var(mb_strtoupper($_POST['nome'],'utf-8'));
						$modelo = filter_var(mb_strtoupper($_POST['modelo'],'utf-8'));
						$serial = filter_var(mb_strtoupper($_POST['serial'],'utf-8'));
						$musicas = filter_var(mb_strtoupper($_POST['musicas'],'utf-8'));
						$padrao = filter_var(mb_strtoupper($_POST['padrao'],'utf-8'));
						
						
						
						$sql = "
						
						UPDATE aparelhos SET
							idAparelhos = :idAparelhos,
							nome = :nome,
							modelo = :modelo,
							serial = :serial,
							musicas = :musicas,
							padrao = :padrao
						WHERE idAparelhos = :idAparelhos
						
						";
						

						
						$stmt = $pdo->prepare($sql);			
						$stmt->bindParam(':idAparelhos', $idAparelhos, PDO::PARAM_INT);		
						$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
						$stmt->bindParam(':modelo', $modelo, PDO::PARAM_STR);		
						$stmt->bindParam(':serial', $serial, PDO::PARAM_STR);		
						$stmt->bindParam(':musicas', $musicas, PDO::PARAM_INT);		
						$stmt->bindParam(':padrao', $padrao, PDO::PARAM_INT);			
						$ress = $stmt->execute();
		
								if($ress){	
									$status = 1;	
									$erro = "Aparelho alterado com sucesso";
								}else{
									$status = 0;					
									$erro = "Erro ao alterar Aparelho";
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
		


	
	// Se existir algum erro, mostra o erro	
	if ( $erro ) {	
		$erro;
		$status = 0;
		$retorno = array('erro'=>$erro, 'status'=>$status);										
		echo json_encode($retorno, JSON_PRETTY_PRINT);			
	} else {
		

	
		
	
		// Se a variável $erro continuar com valor falso				
		try {
			
			$nome = filter_var(mb_strtoupper($_POST['nome'],'utf-8'));
			$modelo = filter_var(mb_strtoupper($_POST['modelo'],'utf-8'));
			$serial = filter_var(mb_strtoupper($_POST['serial'],'utf-8'));
			$musicas = filter_var(mb_strtoupper($_POST['musicas'],'utf-8'));
			$padrao = filter_var(mb_strtoupper($_POST['padrao'],'utf-8'));

			$sql = "INSERT INTO aparelhos (nome, modelo, serial, musicas, padrao) VALUES (:nome, :modelo, :serial, :musicas, :padrao)";			
				$insert = $pdo->prepare($sql);			
				$insert->bindParam(':nome', $nome);
				$insert->bindParam(':modelo', $modelo);		
				$insert->bindParam(':serial', $serial);		
				$insert->bindParam(':musicas', $musicas);		
				$insert->bindParam(':padrao', $padrao);		
				$ress = $insert->execute();
				$lastIdaparelhos = $pdo->lastInsertId();	

				if($ress){	
					$status = 1;	
					$erro = "Aparelho cadastrado com sucesso";
				}else{
					$status = 0;					
					$erro = "Erro ao cadastrar aparelho";
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