<?php 
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
include_once 'conn.php';
	//lista os templates
	
		$idTemplate = $_GET['id'];
	
		$sql= "SELECT * FROM template WHERE idTemplate = :idTemplate";	
		$stmt = $pdo->prepare($sql);	
		$stmt->bindParam(':idTemplate', $idTemplate, PDO::PARAM_INT);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasTemplate = $stmt->fetch();	

	
$html = '


<!DOCTYPE html>
<html lang="pt-BR">
<meta charset="utf-8">
<head>
	<title>Contrato de Reserva de Serviços de Locação de Karaokê</title>
	<link href="css/estilos.css" rel="stylesheet"/>
</head>
<body>	
<htmlpageheader name="header" style="display:none">
	<table width="100%" class="cabecalho">
		<tr>
			<td width="200px"><img src="images/logo.jpg"></td>
			<td width="70%">
				<p><strong>AGÊNCIA OLHAR DIGITAL</strong></p>
				<p>WEDER MONTEIRO ARAUJO – 975.026.851-20 – MEI</p>
				<p>CNPJ: 28.181.684/0001-94</p>
				<p>QMSW 02 CONJUNTO D – LOJA 13A – SALA 01 – SUDOESTE – BRASÍLIA-DF</p>
			</td>
		 </tr>
	</table>
</htmlpageheader>

<htmlpagefooter name="footer" style="display:none">
	<table width="100%">
		<tr>
			<td width="100%" align="right">Pág. {PAGENO} de {nbpg}</td>
		</tr>
	</table>
</htmlpagefooter>

<br />'. $linhasTemplate['template'].'

</body>
</html>

';

//gera o arquivo em html do template
file_put_contents('contrato_novo.html',$html);