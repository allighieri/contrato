<?php
require_once('conn.php');

$idEventos = $_POST['idEventos'];

$idStatus = $_POST['idStatus'];


	
	$sql = "UPDATE eventos SET idStatus = :idStatus WHERE idEventos = :idEventos";
	

	
	$stmt = $pdo->prepare($sql);			
	$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);
	$stmt->bindParam(':idStatus', $idStatus, PDO::PARAM_INT);			
	$ress = $stmt->execute();

			if($ress){	
				$status = 1;	
				echo "Status alterado com sucesso";
				return false;
			}else{
				$status = 0;					
				echo "Erro ao alterar Status";
				return false;	
			}	

