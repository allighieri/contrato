<?php 
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
include_once 'conn.php';

//lista os clientes
	
$sql= "SELECT * FROM aparelhos";
		$stmt = $pdo->prepare($sql);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasAparelhos = $stmt->fetchAll();		
		
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Contrato de Reserva de Serviços de Locação de Karaokê</title>
	<link href="css/style.min.css" rel="stylesheet"/>
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet"/>
	<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet"/>
	
	<link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="js/jquery.mask.min"></script>
	
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

	<!-- Moment.js: -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	 
	<!-- Brazilian locale file for moment.js-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js"></script>
	 
	<!-- Ultimate date sorting plug-in-->
	<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>	
	
	<!-- Tradução portugues dataTable-->
	<script src="js/dataTable-portugues.json"></script>	
	
</head>
<body>	
	<header>
		<div id="topo">
			<img src="images/logo_videoke.png" title="Cadastro de Clientes e Geração de Contratos"/>
			<h1>Lista de Aparelhos</h1>
		</div>
	    
		<?php include_once 'inc/menu.php';?>
		
	</header>	
	
	<section>
		
	<a href="form_aparelhos.php" class="btn_cadastrar_novo" title="Cadastrar um novo template">NOVO APARELHO</a>
	<div class="clear"></div>
	<?php echo (isset($_GET['status']) ? $_GET['status'] : "" );?>
		
	<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Modelo</th>
                <th>Serial</th>
                <th>Musicas</th>
                <th>Padrão</th>
                <th>Ações</th>
             </tr>
        </thead>
        <tbody>
            <?php foreach($linhasAparelhos as $aparelhos){ ?>
			<tr  style="text-align:center;">
				<td><?php echo $aparelhos['nome']; ?></td>
                <td><?php echo $aparelhos['modelo']; ?></td>
                <td><?php echo $aparelhos['serial']; ?></td>
                <td><?php echo $aparelhos['musicas']; ?></td>
                <td><?php echo ($aparelhos['padrao'] == 1) ? "Sim" : "Não"; ?></td>
                
				<td>
					<a href="form_editar_aparelhos.php?id=<?php echo $aparelhos['idAparelhos'] ;?>" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
					
					<a href="aparelhos.php?id=<?php echo $aparelhos['idAparelhos'] ;?>&acao=deletar" title="Deletar Aparelhos">
						<i class="fa fa-trash" aria-hidden="true"></i></td></a>
				</td>
            </tr>
			<?php } ?>
        </tbody>

    </table>
	
	</section>	
	
	

<span class="status"></span>
<script>
$(document).ready(function() {
	
moment.locale('pt-br');
$.fn.dataTable.moment( 'L', 'pt-br' );
	
	var table =	$('#example').DataTable({
		 "order": [[ 0, "asc" ],[4, "asc"]],
		 responsive: true,
		 stateSave: false,
		 searching: true, paging: true, info: true,
		"dom": 'rftip', //retira relementos do Dom
        columnDefs: [
			{ responsivePriority: 1, targets: 0 },
			{ responsivePriority: 3, targets: 1 }


        ],
		 "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
            }
	});
	
	

} );
</script>


</body>
</html>
