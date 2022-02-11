<?php 
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
include_once 'conn.php';

//lista os clientes
	
$sql= "SELECT 
			e.idEventos,
			e.idCliente,
			e.endereco as endEvento,
			e.bairro,
			e.cidade,
			e.uf,
			e.cep as cepFesta,
			e.instalacao,
			e.retirada,
			e.idStatus,
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
			INNER JOIN status as s ON e.idStatus = s.idStatus";
		$stmt = $pdo->prepare($sql);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasEventos = $stmt->fetchAll();	






		
		
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
			<h1>Listas de Eventos</h1>
		</div>
	    
		<?php include_once 'inc/menu.php';?>
		
	</header>	
	
	<section>
		
	<a href="colar_dados_evento.php" class="btn_cadastrar_novo" title="Cadastrar um novo template">NOVO EVENTO</a>
	<div class="clear"></div>
	<?php echo (isset($_GET['status']) ? $_GET['status'] : "" );?>
		
	<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Bairro</th>
                <th>Instalacao</th>
                <th>Hora</th>
                <th>Retirada</th>
                <th>Hora</th>
                <th>Status</th>
                <th>Ação</th>
             </tr>
        </thead>
        <tbody>
            <?php 
			
			function limpaCelular($str){ 
			  return preg_replace("/[^0-9]/", "", $str); 
			}		
			
			
			
			foreach($linhasEventos as $eventos){ ?>
			<tr>
				<td style="white-space:normal !important;"><?php echo $eventos['nome']; ?></td>
                <td><a href="https://api.whatsapp.com/send?phone=+55<?php echo limpaCelular($eventos['telefone']);?>" target="_blank" title="Entrar em contato pelo WhatsApp"><?php echo $eventos['telefone']; ?></a></td>
                <td><?php echo $eventos['bairro']; ?></td>
                <td style="text-align:center;"><?php echo utf8_encode(strftime("%d/%m/%Y", strtotime($eventos['instalacao']))); ?></td>
                <td style="text-align:center;">
					<?php 
						$instalacaohora = new DateTime(utf8_encode($eventos['instalacao'])); // Pega o momento atual
						echo $instalacaohora->format('H:i'); // Exibe no formato desejado					
					?>
				</td>
				
                <td style="text-align:center;"><?php echo utf8_encode(strftime("%d/%m/%Y", strtotime($eventos['retirada']))); ?></td>
                <td style="text-align:center;">
					<?php 
						$retiradahora = new DateTime(utf8_encode($eventos['retirada'])); // Pega o momento atual
						echo $retiradahora->format('H:i'); // Exibe no formato desejado					
					?>
				</td>
				<td><?php echo $eventos['nomeStatus']; ?></td>
				<td style="text-align:center;">
					<a href="form_editar_eventos.php?id=<?php echo $eventos['idEventos'] ;?>" title="Editar">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
						
					<a href="detalhes.php?id=<?php echo $eventos['idEventos'] ;?>" title="Detalhes" target="_blank">
						<i class="fa fa-list-ul" aria-hidden="true"></i></a> |						
					
					<a href="eventos.php?id=<?php echo $eventos['idEventos'] ;?>&acao=deletar" title="Deletar">
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
		 "order": [[ 4, "asc" ],[5, "asc"]],
		 responsive: true,
		 stateSave: false,
		 searching: true, paging: true, info: true,
		"dom": 'rftip', //retira relementos do Dom
        columnDefs: [
			{ responsivePriority: 1, targets: 0 },
			{ responsivePriority: 3, targets: 1 },
			{ responsivePriority: 4, targets: 2 },
			{ responsivePriority: 10001, targets: 3 },
            { responsivePriority: 2, targets: 5 }


        ],
		 "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"
            }
	});
	
	

} );
</script>


</body>
</html>
