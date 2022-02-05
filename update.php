<?php
require_once('conn.php');

						$idCliente = 7;
						$endereco = 'RUA 08';
						$cep = '72.989-00';
						$bairro = 'SETOR OESTE';
						$cidade = 'VARJÃO';
						$uf = 'AC';
						$instalacao = '2022-01-28';
						$horainstalacao = '10:00:00';
						$retirada = '2022-01-29';
						$horaretirada = '10:10:00';
						$idStatus = 6;
	
						$instalacao = $instalacao." ".$horainstalacao.":00";
						$retirada = $retirada." ".$horaretirada.":00";
						
						$sql = "
						
						UPDATE eventos SET
							idCliente = :idCliente,
							endereco = :endereco, 
							cep = :cep,
							bairro = :bairro,
							cidade = :cidade,
							uf = :uf,
							instalacao =:instalacao,
							retirada = :retirada,
							idStatus = :idStatus
						WHERE idEventos = :ideventos
						
						";
						
						
						$stmt = $pdo->prepare($sql);			
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
?>						