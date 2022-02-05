<!DOCTYPE html>
<html lang="pt-BR">

<?php
	date_default_timezone_set('America/Sao_Paulo');	
	
	require_once('../../conn.php');

	$sql= "SELECT * FROM itens";
			$stmt = $pdo->prepare($sql);	
			$stmt->execute();	
			$total = $stmt->rowCount();	
			$linhasItens = $stmt->fetchAll();
			
	$sql= "SELECT * FROM aparelhos";
		$stmt = $pdo->prepare($sql);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasAparelhos = $stmt->fetchAll();		

?>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Contrato de Reserva de Serviços de Locação de Karaokê</title>
	<link href="../../css/style.min.css" rel="stylesheet"/>
	<script src="../../js/jquery.3.6.0-min.js"></script>
	<script src="../../js/jquery.mask.min"></script>
	<script src="../../js/JsLocalSearch.js"></script>
</head>
<body>	
	<header>
		<div id="topo">
			<img src="../../images/logo_videoke.png" title="Cadastro de Clientes e Geração de Contratos"/>
			<h1>Cadastro de Eventos</h1>
		</div>
	    
		
	</header>	
	
	<section>
	
	
		<form id="form_insere_evento" method="POST" name="form" autocomplete="off" action="itens_contrato.php">
			<h2>Cadastrar Itens para:</h2>
			
			<div class="label-float">
				<input id="idEventos" type="text" name="idEventos" value="10" placeholder=" "  />
				 <label>Id Eventos</label>
			</div>	

			
			<div class="label-float">
				<input id="valorDiaria" type="text" name="valorDiaria" value="350.00" placeholder=" "  />
				 <label>Valor da diária</label>
			</div>			
				

			<h2>Aparelho</h2>

			<div class="checkbox">
				<label> Aparelho: </label>
				<?php foreach($linhasAparelhos as $linhasAparelhos){ ?>
					<input type="radio" id="idAparelhos" name="idAparelhos" value="<?php echo $linhasAparelhos['idAparelhos'] ;?>" <?php echo $linhasAparelhos['padrao'] == 1 ? "checked" : ""; ?> />  
					<span class="descAparelho"><?php echo $linhasAparelhos['nome']?> <?php echo $linhasAparelhos['musicas']?> músicas</span>
				<?php } ?>  
			</div>

			<h2>Itens</h2>
			<div class="checkbox">
				
				<?php foreach($linhasItens as $linhasItens){ ?>

					<div>
						<span>Qtde: </span>
						<input type="text" id="qtde<?php echo $linhasItens['idItens'] ;?>" name="qtde[]" value="<?php echo $linhasItens['qtde']; ?>" />					
						<input type="checkbox" data-qtde="<?php echo $linhasItens['qtde']; ?>" id="itens_contrato<?php echo $linhasItens['idItens']; ?>" name="itens[]" value="<?php echo $linhasItens['idItens']; ?>" <?php echo $linhasItens['padrao'] == 1 ? "checked" : ""; ?> />
						<span class="desc"><?php echo $linhasItens['descricao']; ?></span>

					</div>	
					
				<?php } ?>
				
			</div>
			
			<input type="submit" name="btn_enviar" value="Cadastrar" id="btn_enviar"/>
	
		</form>
		
		

	</section>	
	
	

<span class="status"></span>

</body>


</html>
