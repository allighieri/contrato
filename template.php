<?php 
include_once 'conn.php';	

	$erro = false;
	//insere o template no banco de dados

		
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
		
	if(!$erro){
		//variaveis para cadastrar/alterar o template
		$idTemplate = isset($_POST['id_template']) ? $_POST['id_template'] : "";
		$nomeTemplate = isset($_POST['nome_template']) ? $_POST['nome_template'] : "";
		$nomeTemplate = filter_var(mb_strtoupper($nomeTemplate,'utf-8'));		
		$template = isset($_POST['texto']) ? $_POST['texto'] : "";
		$data = date('Y-m-d H:i:s');

		if(isset($_GET)	== isset($_GET['id'])){ // se o id for enviado via get, deleta o registro de mesmo id
		
			if($_GET['id'] == 1){
				
				echo "<script>location.href='listar_templates.php?status=O Template padrão não pode ser excluído!';</script>";
				
			}else{
				try {
					

					$sql = "DELETE FROM template WHERE idTemplate =  :id";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
					$stmt->execute();		

					echo "<script>location.href='listar_templates.php?status=Deletado com sucesso!';</script>";

					
				} catch (PDOException $e) {						
					$erro = $e->getMessage();	
				}	
			}
			
			exit();	
			
			
			
		}
		
		if(isset($_POST) == isset($_POST['id_template'])){ //Se tiver post e for igual a id_template, faz alteração no registro de acordo com o id
			
			try {
				

				$sql = "UPDATE template SET nomeTemplate = :nomeTemplate, template = :template, data = :data WHERE idTemplate = :idTemplate";			
				$altera = $pdo->prepare($sql);			
				$altera->bindParam(':idTemplate', $idTemplate, PDO::PARAM_INT);		
				$altera->bindParam(':nomeTemplate', $nomeTemplate);		
				$altera->bindParam(':template', $template);		
				$altera->bindParam(':data', $data);		
				$pdo->beginTransaction();
				$ress = $altera->execute();
				$lastIdId = $pdo->lastInsertId();
				$pdo->commit();		

				echo "<script>location.href='listar_templates.php?status=Alterado com sucesso!';</script>";

				
			} catch (PDOException $e) {						
				$erro = $e->getMessage();	
			}
			
		}else{ // se o post não for igual a id_template, cadastra um novo registro
				
			try {
				
				

				$sql = "INSERT INTO template (nomeTemplate, template, data) VALUES (:nomeTemplate, :template, :data)";			
				$insert = $pdo->prepare($sql);			
				$insert->bindParam(':nomeTemplate', $nomeTemplate);		
				$insert->bindParam(':template', $template);		
				$insert->bindParam(':data', $data);		
				$pdo->beginTransaction();
				$ress = $insert->execute();
				$lastIdId = $pdo->lastInsertId();
				$pdo->commit();	

				echo "<script>location.href='listar_templates.php?status=Cadastrado com sucesso!';</script>";
				

				
			} catch (PDOException $e) {						
				$erro = $e->getMessage();	
			}
		}	
			
	}else{
		
		echo "<script>location.href='listar_templates.php?status=$erro!';</script>";
	}		
			

	
			

?>



