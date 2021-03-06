<!DOCTYPE html>
<html lang="pt-BR">

<?php
	date_default_timezone_set('America/Sao_Paulo');	
	
	require_once('conn.php');
	
	$idEventos = isset($_GET['id']) ? $_GET['id'] : "";	

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
		
	$idAparelhos = isset($_GET['idAparelhos']) ? $_GET['idAparelhos'] : ""; 
	

		

	$sql= "SELECT
			ap.idAparelhosContrato,
			ap.idAparelhos,
			ap.idEventos,
			ap.valorDiaria,
			a.idAparelhos
			FROM aparelhos_contrato as ap
			INNER JOIN aparelhos as a ON ap.idAparelhos = a.idAparelhos
			WHERE ap.idEventos = :idEventos
			";
			$stmtAparelhos = $pdo->prepare($sql);
			$stmtAparelhos->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);				
			$stmtAparelhos->execute();	
			$total = $stmtAparelhos->rowCount();	
			$linhasAparelhosContrato = $stmtAparelhos->fetch();
			
		


	$sql= "SELECT 
			e.idEventos,
			e.idCliente,
			e.endereco,
			e.bairro,
			e.cidade,
			e.uf,
			e.instalacao,
			e.retirada,
			e.idStatus as eventoStatus,
			c.idCliente, 
			c.idCpfCnpj, 
			c.nome,
			c.telefone,
			c.cep,	
			c.endereco, 
			c.email, 
			cp.idCpfCnpj, 
			cp.cpf_cnpj, 
			cp.data,
			s.idStatus,
			s.nome as nomeStatus
			FROM eventos as e
			INNER JOIN cliente as c ON e.idCliente = c.idCliente
			INNER JOIN cpf_cnpj as cp ON c.idCpfCnpj = cp.idCpfCnpj
			INNER JOIN status as s ON e.idStatus = s.idStatus
			WHERE e.idEventos = :idEventos";
		$stmt = $pdo->prepare($sql);	
		$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasItensEventos = $stmt->fetch();	
		
		$instalacao = new DateTime(utf8_encode($linhasItensEventos['instalacao'])); // Pega o momento atual
		
		

		



		

?>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Contrato de Reserva de Servi??os de Loca????o de Karaok??</title>
	<link href="css/style.min.css" rel="stylesheet"/>
	<script src="js/jquery.3.6.0-min.js"></script>
	<script src="js/jquery.mask.min"></script>
	<script src="js/JsLocalSearch.js"></script>
</head>
<body>	
	<header>
		<div id="topo">
			<img src="images/logo_videoke.png" title="Cadastro de Clientes e Gera????o de Contratos"/>
			<h1>Editar Itens do Eventos</h1>
		</div>
	    
		<?php include_once 'inc/menu.php';?>
	</header>	
	
	<section>
	
		<form id="form_insere_evento" name="form" autocomplete="off">
			<h2>Editar Itens para:</h2>
			
			<input id="idEventos" type="hidden" name="idEventos" value=""/>

			
			<div class="label-float">
				<input type="text" id="gsearchsimple" name="gsearchsimple" value="<?php echo $linhasItensEventos['nome']; ?>" placeholder="Search..." />
				<label>Evento (Nome Cliente)</label>
				<ul class="list_group">

				</ul>
				<div id="localSearchSimple"></div>			
			</div>
			

			<div class="label-float">
				<input id="dataInstalacao" type="text" name="dataInstalacao" value="<?php echo $instalacao->format('d/m/Y'.' ??\s '.'H:i'); ?>" placeholder=" " disabled />
				 <label>Data Instala????o</label>
				 <span class="check"></span>
			</div>
			
			<div class="label-float">
				<input id="valorDiaria" type="text" name="valorDiaria" value="<?php echo $linhasAparelhosContrato['valorDiaria']; ?>" placeholder=" "  />
				 <label>Valor da di??ria</label>
			</div>			
				

			<h2>Aparelho</h2>

			<div class="checkbox">
				<label> Aparelho: </label>
				<?php foreach($linhasAparelhos as $linhasAparelhos){ ?>
					<input type="radio" id="aparelhos<?php echo $linhasAparelhos['idAparelhos']?>" name="aparelhos" value="<?php echo $linhasAparelhos['idAparelhos'] ;?>" <?php echo $linhasAparelhos['idAparelhos'] == $idAparelhos ? "checked" : ""; ?> />  
					<span class="descAparelho"><label class="for" for="aparelhos<?php echo $linhasAparelhos['idAparelhos']?>"><?php echo $linhasAparelhos['nome']?> <?php echo $linhasAparelhos['musicas']?> m??sicas</label></span>
				<?php } ?>  
			</div>

			<h2>Itens</h2>
			<div class="checkbox">
				<?php foreach($linhasItens as $linhasItens){ 
				
				
				//Verifica se tem algum item 
				$sql= "SELECT *	FROM itens_contrato WHERE idEventos = :idEventos AND idItens = :idItens";	
					$linhasItensEv = $pdo->prepare($sql);	
					$linhasItensEv->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);	
					$linhasItensEv->bindParam(':idItens', $linhasItens['idItens'], PDO::PARAM_INT);	
					$linhasItensEv->execute();	
					$total = $linhasItensEv->rowCount();	
					$linhasItensEv = $linhasItensEv->fetch();

				?>


					<div>
						<span>Qtde: </span>
						<input type="text" id="qtde<?php echo $linhasItens['idItens'] ;?>" name="qtde[]" value="<?php echo isset($linhasItensEv['idItens']) ? $linhasItensEv['qtde'] : $linhasItens['qtde']; ?>" />					
						
						<input type="checkbox" data-qtde="<?php echo $linhasItens['qtde']; ?>" id="itens_contrato<?php echo $linhasItens['idItens']; ?>" name="itens[]" value="<?php echo $linhasItens['idItens']; ?>" <?php echo isset($linhasItensEv['idItens']) ? "checked" : ""; ?> />
						<span class="desc"><label class="for" for="itens_contrato<?php echo $linhasItens['idItens']; ?>"><?php echo $linhasItens['descricao']; ?></label></span>

					</div>	
					
				<?php } ?>
				
			</div>
			
			<input type="submit" name="btn_enviar" value="Cadastrar" id="btn_enviar" class="disabled"/>
	
		</form>
		
		

	</section>	
	
	

<span class="status"></span>

</body>



<script>

 //faz a busca pelo nome e coloca o cpf
 $('.list_group').css('display', 'none');

 $('#gsearchsimple').keyup(function(){
  var query = $('#gsearchsimple').val();
  
  $('#dataInstalacao').val('');
  
  if(query.length == 1)
  {
   
	$('.list_group').css('display', 'block');

   $.ajax({
		url:"consulta_eventos.php",
		method:"POST",
		data:{query:query},
		success:function(data)
		{
		 $('.list_group').html(data);
		}
   })
   
  
  }
  if(query.length == 0)
  {
   $('.list_group').css('display', 'none');
  }
 });

 $('#localSearchSimple').jsLocalSearch({
  mincaracteres: 1,
  action:"Show",
  html_search:true,
  mark_text:"marktext"
 });

 $(document).on('click', '.gsearch', function(){
  
  var nome = $(this).text();
  var attr = $(this).attr('data-id');
  
  $('#gsearchsimple').val(nome);
  $('.list_group').css('display', 'none');
  
  

  $.ajax({
   url:"consulta_eventos.php",
   method:"POST",
   data:{attr:attr},
   success:function(data)
   {
	$('#dataInstalacao').val(data);
	$('#idEventos').val(attr);
   }
  })

  
 });

	//Busca a quantidade de cada item toda vez que s??o modificados e adiciona no atributo data-qtde do campo de descri????o de itens
	$("input[name='qtde[]']").on('keyup',function(){
  
		var valor = $(this).val(); // pega o valor da quantidade digitado no campo qtde
	
		$(this).next().attr('data-qtde', valor); 
		
			if(valor < 1){
				$(".status").fadeTo(100, 0.85).html('<span class="danger"><p>Por favor, informe um valor igual ou maior que 1.</p><span class="fechar">X</span></span>');
				$('.fechar').on('click', function(){ $('.status').fadeOut("slow"); });					
			};
  
	});


	
	//INSERE EVENTO
	$(document).on('submit','#form_insere_evento',function(){
				
		//cria o array para as quantidades e descri??~eos
		var idItens = [];
		var qtde = [];
		

		$("input[name='itens[]']:checked").each(function ()
		{	
			var datas = $(this).data("qtde");
		   
			idItens.push( $(this).val());
	   		qtde.push($(this).attr('data-qtde'));
			
			if(qtde < 1){
				$(".status").fadeTo(100, 0.85).html('<span class="danger"><p>Por favor informe um valor igual ou maior que 1.</p><span class="fechar">X</span></span>');
				$('.fechar').on('click', function(){ $('.status').fadeOut("slow"); });
				return false;				
			};			
			

		});	
		
		

		
		var idAparelhos = $('input[name="aparelhos"]:checked').val();
		var idEventos = $('#idEventos').val();
		var valorDiaria = $('#valorDiaria').val();
		var valorDiaria = valorDiaria.trim();
		var idEventos = idEventos.trim();


		console.log(qtde);
		console.log(idItens);
		console.log(idEventos);
		console.log(idAparelhos);
		
		

		if(qtde < 1){
			$(".status").fadeTo(100, 0.85).html('<span class="danger"><p>Por favor informe um valor igual ou maior que 1.</p><span class="fechar">X</span></span>');
			$('.fechar').on('click', function(){ $('.status').fadeOut("slow"); });
			return false;				
		};		
		
		if(idEventos == ''){
			$(".status").fadeTo(100, 0.85).html('<span class="danger"><p>Escolha um evento para inserir os itens.</p><span class="fechar">X</span></span>');
			$('.fechar').on('click', function(){ $('.status').fadeOut("slow"); });
			return false;				
		}		

		if(valorDiaria == ''){
			$(".status").fadeTo(100, 0.85).html('<span class="danger"><p>Informe o valor da loca????o.</p><span class="fechar">X</span></span>');
			$('.fechar').on('click', function(){ $('.status').fadeOut("slow"); });
			return false;				
		};			
		
		var iconCarregando = $('<div id="loading"><div class="preloader preloader-ge"></div><div class="preloader-logo-ge"><svg width="70px" preserveAspectRatio="xMidYMid meet" viewBox="0 0 709 945.33" class="logo_svg" ><path class="fil0" d="M607.95 61.39l-51.87 750.92 -118.57 0 0.79 -13.18c41.61,-8.06 69.43,-22.69 69.43,-39.4l0 -22.37c0,-15.89 -25.17,-29.9 -63.43,-38.17l37.67 -627.92 125.98 -9.88zm-168.88 724.95l0.3 -5.14c22.07,-4.45 39.68,-10.89 50.3,-18.51 -4.68,9.77 -23.61,18.25 -50.6,23.65z"/><path class="fil1" d="M227.03 175.02l54.84 524.62c-37.13,8.31 -61.41,22.11 -61.41,37.72l0 22.37c0,17.03 28.9,31.91 71.85,39.86l8.82 84.35 -121.03 -27.17 -79.05 -699.04 125.98 17.29zm63.26 605.18l0.41 3.96c-16.79,-4.16 -29.55,-9.61 -36.37,-15.81 9.4,4.65 21.64,8.68 35.96,11.85z"/><path class="fil2" d="M236.91 133.02l217.89 -35.58 -7.57 193.9c-6.95,-37.63 -17.23,-73.74 -32.03,-83.14 -29.82,-18.92 -79.13,-23.51 -96.64,-18.04 0,0 -54.16,18.06 -69.88,59.37l-11.77 -116.51zm207.95 219.13l-0.29 7.28 -23.4 -3.13c0,0 14.84,2.48 23.13,10.05l-1.92 49.34c-5.01,9.72 -12.85,18.83 -24.65,24.9 0,0 28.38,-24.94 22.36,-55.9 0,0 -5.16,39.56 -35.27,52.46 0,0 23.23,-24.94 20.65,-54.18 0,0 -7.74,43 -39.57,58.48 0,0 26.67,-30.1 22.36,-61.06 0,0 -5.16,49.03 -43.43,62.79 0,0 29.67,-27.96 24.51,-59.78 0,0 -1.72,40.85 -39.99,57.2 0,0 27.95,-28.82 21.93,-60.21 0,0 -2.58,57.62 -52.9,66.23 0,0 38.28,-14.2 30.54,-73.54 0,0 -2.47,0.23 -6.41,0.87 2.91,41.43 -8.85,49.05 -8.85,49.05 6.24,-18.94 2.53,-40.17 0.9,-47.54 -9.19,1.99 -21.09,5.5 -30.37,11.38 0,0 35.7,-33.97 95.9,-28.38 0,0 -44.29,-12.48 -94.18,9.03 0,0 26.67,-29.68 90.74,-25.38 0,0 -33.54,-16.34 -94.18,7.31 0,0 26.24,-38.7 92.46,-27.52 0,0 -53.32,-18.49 -95.04,8.6 0,0 33.55,-36.12 94.18,-24.94 0,0 -42.14,-20.21 -98.48,8.17 0,0 23.22,-36.12 95.04,-26.66 0,0 -56.34,-22.8 -95.47,7.74 0,0 21.07,-34.41 94.18,-26.23 0,0 -55.04,-23.23 -96.33,9.03 0,0 16.77,-42.58 93.75,-25.38 0,0 -39.13,-27.95 -98.48,9.03 0,0 24.94,-33.54 60.21,-31.39 0,0 17.63,0 35.12,3.08 0,0 -20.12,-13.41 -55.08,-10.05 0,0 0.96,-22.52 -23.47,-19.64 0,0 23.47,-24.91 37.84,5.27 0,0 0.96,-7.19 -3.36,-12.46 0,0 16.77,-6.22 21.56,16.29 0,0 1.44,-11.98 -1.92,-16.29 0,0 19.64,2.4 21.08,18.68 0,0 1.56,-7.46 -1.67,-13.48 0,0 14.19,1.72 19.57,17.41 0,0 0,-8.81 -1.51,-12.04 0,0 13.34,5.38 16.99,19.78 0,0 0,-6.88 -1.5,-10.75 0,0 10.53,9.68 14.62,24.73l-23.02 -3.38c-1.04,-3.02 -2.16,-5.88 -3.35,-8.54 0,0 13.99,86.53 19.17,141.97 0,0 0.35,-66.48 -10.54,-114.52 1.62,0.64 20.98,8.55 26.12,18.23 0,0 -15.26,-1.5 -21.93,-1.08 0,0 21.07,3.44 25.38,16.78 0,0 -16.56,-1.08 -23.66,-0.22 0,0 21.72,8.17 26.02,13.98 0,0 1.94,3.22 -1.51,3.87 -3.44,0.64 -21.5,-0.22 -21.5,-0.22 0,0 23.01,6.89 24.73,18.93l-24.08 -1.72c0,0 26.66,1.72 26.66,16.34l-24.08 1.72c0,0 17.36,2.11 23.69,9.61zm-3.02 77.34l-10.43 267.22c-2.49,-0.42 -5.02,-0.83 -7.59,-1.2 -0.16,-14.06 -3.71,-56.77 -39.08,-86.36l0 -83.48c8.97,-2.26 16.1,-7.52 17.5,-18.14 2.91,-22.12 2.27,-43.05 1.56,-54.27 16.65,-5.88 29.15,-14.32 38.04,-23.77zm-13.81 353.76l-0.2 5.09c-17.23,2.7 -37.01,4.24 -58.04,4.24 -24.7,0 -47.67,-2.12 -66.82,-5.76l-0.42 -4.21c19.16,3.34 41.2,5.24 64.66,5.24 21.91,0 42.58,-1.66 60.82,-4.6zm-0.7 17.8l-2.17 55.72 -116.62 -14.82 -4.08 -40.35c18.17,2.66 38.36,4.14 59.64,4.14 22.69,0 44.15,-1.69 63.23,-4.69zm-133.41 -103.84l-28.54 -282.46c2.44,9.24 5.29,17.48 8.76,24.53 0,0 1.84,13.47 33.46,19.6l0.34 11.49c0,0 -16.56,36.91 15.61,42.59 0,0 4.74,4.73 -11.35,30.28 -16.09,25.56 8.04,50.17 34.54,61.05 0.34,0.14 0.67,0.28 1.02,0.43l0 131.35 -12.27 -43.81c-14.81,0.96 -28.79,2.65 -41.57,4.95zm-28.73 -284.27l-0.76 -7.55 8.56 -5.82 -7.8 13.37zm-1.92 -19.01l-0.81 -7.99 8.81 -5 -8 12.99zm-1.83 -18.11l-0.58 -5.79 8.55 -5.29 -7.97 11.08zm-1.66 -16.48l-0.58 -5.73 6.91 -6.07 -6.33 11.8zm-2.09 -20.61l-0.42 -4.21 7.69 -5.33 -7.27 9.54zm-1.85 -18.34l-0.26 -2.6 7.66 -5.8 -7.4 8.4zm-1.72 -17.07l-0.51 -5.01 6.77 -4.1 -6.26 9.11zm-1.79 -17.71l-0.36 -3.5 9.55 -6.82 -9.19 10.32zm115.21 454.77l2.15 -262.77 3.01 23.23 0.64 239.43 -5.8 0.11zm17.2 -48.56l0 -57.32c11.8,15.1 20.7,34.98 20.42,58.76 -6.62,-0.63 -13.44,-1.11 -20.42,-1.44zm-36.98 -103.24c-1.04,-0.36 -2.08,-0.72 -3.15,-1.06 0,0 -34.41,-13.77 -18.92,-41.29 15.48,-27.52 13.76,-24.08 13.76,-24.08 0,0 3.27,1.01 8.31,2.12l0 64.31zm3.13 -74.41l0.97 0c10.44,-13.27 9.48,-48.18 9.48,-48.18l25.46 0.69 4.81 41.28c6.2,-24.77 1.38,-56.42 1.38,-56.42l-39.91 -0.69c2.72,29 -1.19,56.93 -2.19,63.32zm-28.34 31.98c0,0 -23.02,27 19.69,46.48 0,0 -31.65,-14.61 -19.69,-46.48zm67.99 81.34c0,0 21.51,15.48 25.38,55.04 0,0 4.3,-41.71 -25.38,-55.04zm-62.91 -158.05c10.65,0 19.28,8.63 19.28,19.27 0,10.65 -8.63,19.28 -19.28,19.28 -1.97,0 -3.87,-0.29 -5.66,-0.84 9.28,-1.39 16.4,-9.4 16.4,-19.07 0,-8.67 -5.73,-16.01 -13.62,-18.43 0.94,-0.14 1.9,-0.21 2.88,-0.21zm81.38 -213.56c-1.51,-6.67 -3.24,-12.99 -5.22,-18.72 3.34,1.41 23.56,10.28 27.7,19.15l-22.48 -0.43zm-26.75 -31.55c0,0 14.51,63.22 20.72,141.45 0,0 2.08,-90.15 -20.72,-141.45zm-113.28 27.88c0,0 4.01,92.89 18.35,159.98 0,0 -27.53,-89.45 -18.35,-159.98zm12.46 -9.75c0,0 4.93,100.88 22.52,173.74 0,0 -33.77,-97.14 -22.52,-173.74zm38.43 -18.78c0,0 2.5,-11.02 -6.26,-16.03 -8.77,-5.01 -16.28,4.26 -16.28,4.26 0,0 17.03,-6.51 22.54,11.77z"/></svg></div></div>');
	
		$.ajax({
			url: 'itens_contrato.php',
			type: "POST",
			data: {'idItens':idItens, 'qtde':qtde, 'idEventos':idEventos, 'idAparelhos':idAparelhos, 'valorDiaria':valorDiaria},
			beforeSend: function() {
				$('#carregando').html(iconCarregando); 
			},
			complete: function() {
				$(iconCarregando).remove(); 
			},
			success: function( data ) {
				//console.log(data);
				
				var res = JSON.parse(data);
				
				console.log(res.erro);
				
						if(res.status == 1){
							$(".status").fadeTo(500, 0.85).html('<span class="success"><p>'+ res.erro +'</p><span class="fechar">X</span></span>');
							$('.fechar').on('click', function(){ $('.status').fadeOut("slow"); });
							
								$('.check').fadeOut("fast");
								$('#form_insere_evento input').val("");
								$('#btn_enviar').val("Cadastrar");	
								$('#form_insere_evento input').val("");

								$('.success').on('click', function(){
									window.location.href = "listar_itens_contrato.php";
								});									
							
							
						}
						
						if(res.status == 0){
							$(".status").fadeTo(500, 0.85).html('<span class="danger"><p>'+ res.erro +'</p><span class="fechar">X</span></span>');
							$('.fechar').on('click', function(){ $('.status').fadeOut("slow"); });
						}
				
				
				
			},
			error: function (request, status, error) {
				alert(request.responseText);
				$('#erro').modal({
				  closeExisting: true
				});							
			}
		});
		return false;
	});

</script>


</html>
