<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Auto Complete</title>
	<link href="../css/style.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="js/jquery.mask.min"></script>
</head>
<body>	
	<header>
		<div id="topo">
			<img src="../images/logo_videoke.png" title="Cadastro de Clientes e Geração de Contratos"/>
			<h1>Cadastro de Clientes</h1>
		</div>
	    
		<?php include_once '../inc/menu.php';?>
	</header>	
	
	<section>
		
		
		

	</section>	
	
	

<span class="status"></span>

</body>




</html>






<script type="text/javascript">
function pegarIdDaReceitaEditar(id){
	var idReceita = id;
	alert(idReceita);
	$.ajax({
	type: "GET",
	url: "buscarDadosReceita.php?id="+idReceita,
	success: function( response ){
	var dadosReceita = jQuery.parseJSON( response );

	$("#dadoDaReceita").val(dadosReceita.dadoDaReceita);
	// alert("teste01R-R");

	$.ajax({
	 type: "GET",
	 url: "buscarDadosReceitaDescricao.php?id="+idReceita,
	 success: function( response ){

	   if(response){
	   var dadosReceitaDescricao = jQuery.parseJSON( response );
	   //console.warn(dadosReceitaDescricao);

	   $("#numero_de_linhas").val(dadosReceitaDescricao.numero_de_linhas);
	   // alert("teste01R-D");

	   for($i=0; $i<$dadosReceitaDescricao.numero_de_linhas; $i++){

	   $("#dadoDeDescricaoDaReceita"+$i)
	   .val(dadosReceitaDescricao.dadoDeDescricaoDaReceita);

	   $.each(dadosReceitaDescricao, function(i, descricao) {

		 var descCallB = $("string com os dados da descricao");

	   }

	  }else{
		 console.warn('erro: sem resposta.');
	  }
	   }
	 }
	});

	}
	});
 }
</script>
