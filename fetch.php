<?php

require_once('conn.php');

if(isset($_POST['query']))
{
	
	$search = '%'.trim($_POST["query"]).'%';
	
	$sql= "SELECT 
		c.idCliente, 
		c.idCpfCnpj, 
		c.nome, 
		c.telefone,
		c.endereco, 
		c.bairro,
		c.cidade,
		c.uf,		
		c.email, 
		cp.idCpfCnpj, 
		cp.cpf_cnpj, 
		cp.data 
		FROM cliente as c INNER JOIN cpf_cnpj as cp 
		on c.idCpfCnpj = cp.idCpfCnpj 
		WHERE c.nome like :nome";	
	$stmt = $pdo->prepare($sql);	
	$stmt->bindParam(':nome', $search, PDO::PARAM_STR);	
	$stmt->execute();	
	$total = $stmt->rowCount();	
	$cliente = $stmt->fetchAll();	
	

	
	
 $output = '';
 
 if($total >= 1){

	 foreach($cliente as $row)
	 {
	  $output .= '
	  <li class="lista_clientes contsearch">
	   <a href="javascript:void(0)" class="gsearch" data-id='.$row["idCpfCnpj"].'>'.$row["nome"].'</a>
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
	
	$sql= "SELECT 
		c.idCliente, 
		c.idCpfCnpj, 
		c.nome, 
		c.telefone,
		c.endereco, 
		c.bairro,
		c.cidade,
		c.uf,		
		c.email, 
		cp.idCpfCnpj, 
		cp.cpf_cnpj, 
		cp.data 
		FROM cliente as c INNER JOIN cpf_cnpj as cp 
		on c.idCpfCnpj = cp.idCpfCnpj 
		WHERE c.idCpfCnpj = :idCpfCnpj";	
	$stmt = $pdo->prepare($sql);	
	$stmt->bindParam(':idCpfCnpj', $search, PDO::PARAM_STR);	
	$stmt->execute();	
	$total = $stmt->rowCount();	
	$cliente = $stmt->fetch();

	echo $cliente['cpf_cnpj'];
	
}

?>