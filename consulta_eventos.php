<?php

require_once('conn.php');

if(isset($_POST['query']))
{
	
	$search = '%'.trim($_POST["query"]).'%';
	
	$sql= "SELECT 
			e.idEventos,
			e.idCliente,
			e.endereco,
			e.bairro,
			e.cidade,
			e.uf,
			e.instalacao,
			e.retirada,
			e.idStatus,
			c.idCliente, 
			c.idCpfCnpj, 
			c.nome,
			c.telefone,
			c.cep,	
			c.endereco, 
			c.email
			FROM eventos as e
			INNER JOIN cliente as c ON e.idCliente = c.idCliente
		WHERE c.nome like :nome AND e.idEventos NOT IN (SELECT idEventos FROM aparelhos_contrato)";	
	$stmt = $pdo->prepare($sql);	
	$stmt->bindParam(':nome', $search, PDO::PARAM_STR);	
	//$stmt->bindParam(':instalacao', $search, PDO::PARAM_STR);	
	$stmt->execute();	
	$total = $stmt->rowCount();	
	$cliente = $stmt->fetchAll();	
	

	
	
 $output = '';
 
 if($total >= 1){

	 foreach($cliente as $row)
	 {
	
		$instalacao = new DateTime(utf8_encode($row['instalacao'])); // Pega o momento atual
					 
	  $output .= '
	  <li class="lista_clientes contsearch">
	   <a href="javascript:void(0)" class="gsearch" data-id='.$row["idEventos"].'>'.$row["nome"].' - '.$instalacao->format('d/m/Y'.' à\s '.'H:i').'</a>
	  </li>
	  ';
	 }
	 
	 echo $output;

 }else{
	 $output .= '
	  <li class="lista_clientes contsearch">
	   <a href="javascript:void(0)" class="gsearch">Cliente não encontrado</a>
	  </li>
	  ';
	  
	  echo $output;
 }

 
 

}



if(isset($_POST['attr']))
{
	$search = $_POST['attr'];
	
	$sql= "SELECT * FROM eventos
		WHERE idEventos = :idEventos";	
	$stmt = $pdo->prepare($sql);	
	$stmt->bindParam(':idEventos', $search, PDO::PARAM_STR);	
	$stmt->execute();	
	$total = $stmt->rowCount();	
	$eventos = $stmt->fetch();
	
	$instalacao = new DateTime(utf8_encode($eventos['instalacao'])); // Pega o momento atual
	echo $instalacao->format('d/m/Y'.' à\s '.'H:i');
	
}

?>