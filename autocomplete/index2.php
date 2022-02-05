<!DOCTYPE HTML>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<script type="text/javascript">
		
		var query = "weder";
		
		$.ajax({
			url: 'dados.php',
			type: "POST",
			data:{query:query},
			beforeSend: function() {
				//$('#carregando').html(iconCarregando); 
			},
			complete: function() {
				//$(iconCarregando).remove(); 
			},
			success: function( data ) {

				var dados = data;
				
				//console.log(dados);
				
				for(s in dados){
					var res = dados[s];
					console.log(res.nome);
				}				
				
	
			},
			error: function (request, status, error) {
				alert(request.responseText);
			}
		});		
		
		
	</script>
</body>
</html>