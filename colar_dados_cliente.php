<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Contrato de Reserva de Serviços de Locação de Karaokê</title>
	<link href="css/style.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="js/jquery.mask.min"></script>
</head>
<body>	
	<header>
		<div id="topo">
			<img src="images/logo_videoke.png" title="Cadastro de Clientes e Geração de Contratos"/>
			<h1>Cadastro de Clientes - 1</h1>
		</div>
	    
		<?php include_once 'inc/menu.php';?>
		
	</header>	
	
	<section>
		
			<p class="infor">
				Copie os dados do questionário respondido pelo cliente no WhatsApp e cole no campo abaixo para transferi-los para os campos do formulário ao clicar em enviar
			</p>
		
		<form action="form_cliente.php" method="post">
			
			<div class="label-float">
				<textarea name="texto" value="" placeholder=""></textarea>
				<label class="dados">Cole aqui os dados do cliente</label>
			</div>			
			<input type="submit" value="Enviar">
		</form>
		
		
	
	</section>	
	
	

<span class="status"></span>

</body>
</html>
