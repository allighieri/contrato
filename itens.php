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
					

					$sql = "DELETE FROM itens WHERE idItens =  :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
					$stmt->execute();		

					echo "<script>location.href='listar_itens.php?status=Deletado com sucesso!';</script>";

					
				} catch (PDOException $e) {	
				
					$erro = $e->getMessage();	
				}	
					
			exit();	
			
		}		
		
		
		
		if(isset($_POST['acao']) && $_POST['acao'] == "editar"){ 
		
		



			if(empty($_POST['descricao'])){
				$erro = "Informe a descrição de um item.";
			}

			if(empty($_POST['qtde'])){
				$erro = "Quantidade inválida. Informe um valor igual ou maior que 1.";
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
						$qtde = filter_var($_POST['qtde']);
						
						$sql = "
						
						UPDATE itens SET
							idItens = :idItens,
							descricao = :descricao,
							padrao = :padrao,
							qtde = :qtde
						WHERE idItens = :idItens
						
						";
						
						
						$stmt = $pdo->prepare($sql);			
						$stmt->bindParam(':idItens', $idItens, PDO::PARAM_INT);		
						$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);		
						$stmt->bindParam(':padrao', $padrao, PDO::PARAM_INT);		
						$stmt->bindParam(':qtde', $qtde, PDO::PARAM_INT);		
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
	// Cria as variáveis dinamicamente	
		
	foreach ( $_POST as $chave => $valor ) {		
		// Remove todas as tags HTML		
		// Remove os espaços em branco do valor		
		$$chave = trim(strip_tags($valor));	

		$valor = trim(strip_tags($valor));		
		
		// Verifica se tem algum valor nulo		
		if ( empty($descricao)) {			
			$erro = 'Existem campos em branco.';		
		}	
	}			

	if($_POST['qtde'] < 0){
		$erro = 'Quantidade inválida. Insira o valor 1 ou maior.';
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
			
			$descricao = filter_var($_POST['descricao']);
			$qtde = filter_var($_POST['qtde']);

			$sql = "INSERT INTO itens (descricao, padrao, qtde) VALUES (:descricao, :padrao, :qtde)";			
				$insert = $pdo->prepare($sql);			
				$insert->bindParam(':descricao', $descricao);
				$insert->bindParam(':padrao', $padrao);		
				$insert->bindParam(':qtde', $qtde);		
				$ress = $insert->execute();
				$lastIdItens = $pdo->lastInsertId();	

				if($ress){	
					$status = 1;	
					$erro = "Item cadastrado com sucesso";
				}else{
					$status = 0;					
					$erro = "Erro ao cadastrar item ";
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