<?php 
include_once 'conn.php';
			
			
			
	//lista os templates
	
	
	$idTemplate = $_GET['id'];
	
		$sql= "SELECT * FROM template WHERE idTemplate = :idTemplate";	
		$stmt = $pdo->prepare($sql);	
		$stmt->bindParam(':idTemplate', $idTemplate, PDO::PARAM_INT);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasTemplate = $stmt->fetch();	
		

?>		

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Contrato de Reserva de Serviços de Locação de Karaokê</title>
	<link href="css/style.min.css" rel="stylesheet"/>
	<link href="css/simditor.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	
	
	<script type="text/javascript" src="js/module.js"></script>
	<script type="text/javascript" src="js/hotkeys.js"></script>
	<script type="text/javascript" src="js/uploader.js"></script>
	<script type="text/javascript" src="js/simditor.js"></script>	
	
	
</head>
<body>	
	<header>
		<div id="topo">
			<img src="images/logo_videoke.png" title="Cadastro de Clientes e Geração de Contratos"/>
			<h1>Editar Template</h1>
		</div>
	    
		<?php include_once 'inc/menu.php';?>
		
	</header>	
	
	<section>
		
		
		<form action="template.php" method="post" id="form_edit_template">

			<input id="id_template" type="hidden" name="id_template" value="<?php echo $linhasTemplate['idTemplate']; ?>" placeholder=" "/>
			
			<div class="label-float">
				<input id="nome_template" type="text" name="nome_template" value="<?php echo $linhasTemplate['nomeTemplate']; ?>" placeholder=" "/>
				 <label>Nome Template</label>
			</div>			
			
			
			<textarea id="edit_template" name="texto" value="" placeholder="">
				<?php echo $linhasTemplate['template']; ?>
			</textarea>
			
			<input type="submit" value="Cadastrar">
		</form>
	
	</section>	
	
	

<span class="status"></span>


<script>
(function() {
  $(function() {
    var editor,toolbar;
    Simditor.locale = 'pt-BR';
    toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'];
 
    editor = new Simditor({
      textarea: $('#edit_template'),
      placeholder: 'Digite os termos do contrato aqui',
      toolbar: toolbar,
      pasteImage: true,
      defaultImage: '/simditor/images/image.png',
      upload: false
    });
  });
 
}).call(this);
</script>

</body>
</html>
