<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require_once('conn.php');
require_once('inc/clsTexto.php');

$idEventos = isset($_GET['id']) ? $_GET['id'] : 18;


	
	$sql= "SELECT 
			e.idEventos,
			e.idCliente,
			e.endereco,
			e.bairro,
			e.cidade,
			e.uf,
			e.cep,
			e.instalacao,
			e.retirada,
			e.idStatus,
			c.idCliente, 
			c.idCpfCnpj, 
			c.nome,
			c.telefone,
			c.cep as cepcliente,	
			c.endereco as enderecocliente, 
			c.bairro as bairrocliente,
			c.cidade as cidadecliente,
			c.uf as ufcliente,
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
			WHERE e.idEventos = :idEventos
			";
		$stmt = $pdo->prepare($sql);	
		$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);	
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasEventos = $stmt->fetch();	


	$sql= "SELECT 
		ic.idItensContrato,
		ic.idItens,
		ic.idEventos,
		ic.qtde,
		i.idItens,
		i.descricao,
		i.padrao,
		e.idEventos,
		e.idCliente
		FROM itens_contrato as ic
		INNER JOIN itens as i ON ic.idItens = i.idItens
		INNER JOIN eventos as e ON ic.idEventos = e.idEventos
		WHERE ic.idEventos = :idEventos
		";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);		
		$stmt->execute();	
		$totalItens = $stmt->rowCount();	
		$linhasItens = $stmt->fetchAll();
		
	$sql= "SELECT 
			ac.idAparelhosContrato,
			ac.idAparelhos,
			ac.idEventos,
			ac.valorDiaria,
			a.idAparelhos,
			a.nome,
			a.modelo,
			a.serial,
			a.musicas,
			a.padrao
			FROM aparelhos_contrato as ac
			INNER JOIN aparelhos as a ON ac.idAparelhos = a.idAparelhos
			WHERE ac.idEventos = :idEventos
			";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);		
		$stmt->execute();	
		$total = $stmt->rowCount();	
		$linhasAparelhos = $stmt->fetch();		
		
		

use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';

$data_evento = $linhasEventos['instalacao'];

//variáveis para preencher o contrato com os dados do cliente e do evento
$codigo_contrato = $linhasEventos['cpf_cnpj'];

$nome = $linhasEventos['nome'];
$cpf_cnpj = $linhasEventos['cpf_cnpj'];

$doc = strlen($cpf_cnpj) > 14 ? "CNPJ" : "CPF";
$nome_razao = strlen($cpf_cnpj) > 14 ? "Razão Social" : "Nome";

$telefone = $linhasEventos['telefone'];
$endereco = $linhasEventos['enderecocliente'];
$bairro = ", ".$linhasEventos['bairrocliente'];

$cidade = ", ".$linhasEventos['cidadecliente'];
$uf = "-".$linhasEventos['ufcliente'];
$cep = ", ".$linhasEventos['cepcliente'];

$email = $linhasEventos['email'];
$endereco_festa = $linhasEventos['endereco'];
$bairro_festa = ", ".$linhasEventos['bairro'];
$cidade_festa = ", ".$linhasEventos['cidade'];
$uf_festa = "-".$linhasEventos['uf'];
$cep_festa = ", ".$linhasEventos['cep'];



$data_evento = utf8_encode(strftime("%d/%m/%Y", strtotime($data_evento)));


$instalacao = new DateTime(utf8_encode($linhasEventos['instalacao'])); // Pega o momento atual
$retirada = new DateTime(utf8_encode($linhasEventos['retirada'])); // Pega o momento atual



    $data_inicio = new DateTime(utf8_encode(strftime("%Y/%m/%d", strtotime($linhasEventos['instalacao']))));
    $data_fim = new DateTime(utf8_encode(strftime("%Y/%m/%d", strtotime($linhasEventos['retirada']))));
    // Resgata diferença entre as datas
    $dateInterval = $data_inicio->diff($data_fim);



$data_hora_entrega = $instalacao->format('d/m/Y'.' à\s '.'H:i');
$data_hora_devolucao = $retirada->format('d/m/Y'.' à\s '.'H:i');
$diaria_quantidade = $dateInterval->days;
$texto_diarias = ($diaria_quantidade > 1) ? "diárias" : "diária";
$diaria_quantidade = $diaria_quantidade." ".$texto_diarias;

$valor = $linhasAparelhos['valorDiaria'];

$extenso = clsTexto::valorPorExtenso($valor, true, false);

$valor_extenso = $extenso;

$data_contrato = utf8_encode(strftime("%d de %B de %Y", strtotime(date("Y-m-d"))));

$valorDiaria = preg_replace("/[^0-9]/", "", $valor); //retira tudo que não seja números
$valorDiaria = substr_replace($valorDiaria, ',', -2, 0); //acrescenta um ponto nos depois dos dois ultimos numeros da direita para esquerda

$valor = $valorDiaria;


	$itens = '<table id="tb_itens" border="1" cellpadding="5" cellspacing="0" width="100%">'; 
	$itens .= '<thead><tr><th colspan="3">Itens do Contrato</th></tr></thead>';
	$itens .= '<tr><th>Item</th><th>Qtde</th><th>Descrição do Item</th></tr>';
	$itens .= '<tr>';
	$itens .= 	'<td>';
	$itens .= 		'<strong>1</strong>'; 
	$itens .= 	'</td>';
	$itens .= 	'<td>';
	$itens .= 		'<strong>1</strong>'; 
	$itens .= 	'</td>';
	$itens .= 	'<td class="desc">';
	$itens .= 	"<strong>Videokê modelo ".$linhasAparelhos['modelo'].", serial nº ".$linhasAparelhos['serial']." com ".$linhasAparelhos['musicas']." músicas</strong>"; 
	$itens .= 	'</td>';
	$itens .= '</tr>';

	
	$i = 2;

foreach($linhasItens as $linhasItens) {
	
	
	
	$itens .= '<tr>';
	$itens .= 	'<td>';
	$itens .= 		$i++; 
	$itens .= 	'</td>';
	$itens .= 	'<td>';
	$itens .= 		$linhasItens['qtde']; 
	$itens .= 	'</td>';
	$itens .= 	'<td class="desc">';
	$itens .= 		$linhasItens['descricao'];
	$itens .= 	'</td>';
	$itens .= '</tr>';
	

} 
		
	$itens .= '</table>';	




$css = file_get_contents('css/estilos.css');


$html = file_get_contents('contrato_novo.html');


$variaveis = [
	"contrato"=>[
		"%codigo_contrato%"		=> $codigo_contrato,
		"%data_contrato%"		=>$data_contrato,
		"%nome_razao%"			=>$nome_razao,
		"%doc%" 				=> $doc
	],
    "cliente"=> [
		"%nome%"				=>$nome,
		"%cpf_cnpj%"			=>$cpf_cnpj,
		"%telefone%"			=> $telefone,
		"%endereco%"			=>$endereco,
		"%bairro%"				=>$bairro,
		"%cidade%"				=>$cidade,
		"%uf%"					=>$uf,
		"%cep%"					=>$cep,
		"%email%"				=>$email
	],
	"itens" =>[
			"%itens%"			=>$itens
		],
	"festa" => [
		"%endereco_festa%"		=> $endereco_festa,
		"%bairro_festa%"		=> $bairro_festa,
		"%cidade_festa%"		=> $cidade_festa,
		"%uf_festa%"			=> $uf_festa,
		"%cep_festa%"			=> $cep_festa,
		"%data_evento%"			=> $data_evento,
		"%data_hora_entrega%"	=> $data_hora_entrega,
		"%data_hora_devolucao%"	=> $data_hora_devolucao,
		"%diaria_quantidade%"	=> $diaria_quantidade,
		"%valor%"				=> $valor,
		"%valor_extenso%"		=> $valor_extenso
		]
	];

    $contrato = $html;
    $contrato = strtr($contrato,$variaveis['contrato']);
    $contrato = strtr($contrato,$variaveis['cliente']);
    $contrato = strtr($contrato,$variaveis['itens']);
	$html = strtr($contrato,$variaveis['festa']);

//$mpdf = new mPDF('','A4',10,'DejaVuSansCondensed'); // Página, fonte;



$mpdf = new Mpdf([
	'mode' => 'utf-8',
    'format' => 'A4-P', //L = Landscape, P = Portable 'format' => [150, 150], // Define medida especifica 'orientation' => 'P', //Orientação da página quando definido medida especifica
	'default_font_size' => 9,
	'default_font' => 'calibri'
]);


$instalacao = new DateTime(utf8_encode($linhasEventos['instalacao'])); // Pega o momento atual
$instalacao = $instalacao->format('d m y');

$nome = $linhasEventos['nome'];
$nome = explode(" ", $nome);

$sobrenome = $nome[1];
$sobrenome = strlen($sobrenome);

$nomeCliente = ($sobrenome <= 2) ? $nome[0]." ".$nome[2] : $nome[0]." ".$nome[1];




$nomePDF = $instalacao." CONTRATO VIDEOKE - ".$nomeCliente;


//$mpdf->SetDisplayMode('fullpage');
//$mpdf->mirrorMargins = 1;
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='utf-8';
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->SetAuthor('Videoke Clube'); // Autor
$mpdf->SetSubject("Contrato de Serviço de Locação de Videokê"); //Assunto
$mpdf->SetTitle('Contrato Reserva de Locação de Videokê'); //Titulo
$mpdf->SetKeywords('videokê clube, videokê, karaokê, cantar'); //Palavras chave
$mpdf->SetCreator('Videokê Clube'); //Criador
$gerar = $mpdf->Output('contrato/pdf/tmp/'.$nomePDF.".pdf", 'F');  // se colocar D força o download no lugar de I
$gerar = $mpdf->Output('contrato/pdf/tmp/'.$nomePDF.".pdf", 'I');  // se colocar D força o download no lugar de I


//gera o arquivo em html do contrato
file_put_contents('contrato/html/tmp/'.$nomePDF.'.html',$html);

ob_clean();


	
	
	$idStatus = 8; // Enviar (Contrato)	
	
	$sql = "UPDATE eventos SET idStatus = :idStatus WHERE idEventos = :idEventos";
	

	
	$stmt = $pdo->prepare($sql);			
	$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);
	$stmt->bindParam(':idStatus', $idStatus, PDO::PARAM_INT);			
	$ress = $stmt->execute();

			if($ress){	
				$status = 1;	
				$erro = "Status alterado com sucesso";
			}else{
				$status = 0;					
				$erro = "Erro ao alterar Status";
				return false;	
			}	



