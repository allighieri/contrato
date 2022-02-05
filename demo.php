<?php

$data_evento = "2021-08-17";

$codigo_data = utf8_encode(strftime("%d%m%Y", strtotime($data_evento)));

//variáveis para preencher o contrato com os dados do cliente e do evento
$codigo_contrato = "VSK.3.C-".$codigo_data;

$nome = "Sullivan Pereira da Silva";
$cpf_cnpj = "975.026.851-20";

$doc = strlen($cpf_cnpj) > 14 ? "CNPJ" : "CPF";
$nome_razao = strlen($cpf_cnpj) > 14 ? "Razão Social" : "Nome";

$telefone = "61 99253-0902";
$endereco = "ST. N CNN 1 LOJA 3";

$cidade = "Ceilândia";
$uf = "DF";
$cep = ", 72225-509";

$email = "putzlounge@gmail.com";
$endereco_festa = "PUTZ LOUNGE. ST. N CNN 1 LOJA 3";

$cidade_festa = "Ceilândia";
$uf_festa = "DF";
$cep_festa = ", 72225-509";

$data_evento = utf8_encode(strftime("%d/%m/%Y", strtotime($data_evento)));

$data_hora_entrega = "17/08/2021 às 15:00";
$data_hora_devolucao = "18/08/2021 às 15:00";
$diaria_quantidade = 1;
$texto_diarias = ($diaria_quantidade > 1) ? "diárias" : "diária";
$diaria_quantidade = $diaria_quantidade." ".$texto_diarias;
$valor = 350;
$valor_extenso = "Trezentos e cinquenta reais";
$data_contrato = utf8_encode(strftime("%d de %B de %Y", strtotime(date("Y-m-d"))));



// dados dos aparelhos
$videoke_modelo = "VIDEOKE VSK 3.0 da RAF Eletronic";
$serial = "SMDYK01D";
$musicas = "11.091 músicas";
$qtde_som = "02";
$caixa = $qtde_som > 01 ? "caixas":"caixa";
$som = $qtde_som." ".$caixa." de som amplificada Stanner SR315A 300w Rms com entrada para pen drive e conexão bluetooth;";
$microfones = "microfones sem fio original do karaokê descrito no item a) desta cláusula;";
$pilhas = "pilhas recarregáveis para microfone;";
$lista = "Listas de músicas impressas em ordem alfabética por intérprete;";
$qtde_tv = "01";
$tv = $qtde_tv." Tv 32\" Philips Modelo 32PHG4900/78.";


$variaveis = [
	"contrato"=>[
		"%codigo_contrato%" => $codigo_contrato,
		"%data_contrato%"=>$data_contrato,
		"%nome_razao%"=>$nome_razao,
		"%doc%" => $doc
	],
    "cliente"=> [
		"%nome%"=>$nome,
		"%cpf_cnpj%"=>$cpf_cnpj,
		"%telefone%" => $telefone,
		"%endereco%"=>$endereco,
		"%cidade%"=>$cidade,
		"%uf%"=>$uf,
		"%cep%"=>$cep,
		"%email%"=>$email
	],	
	"itens" =>[
			"%musicas%"=>$musicas,
			"%tv%"=>$tv,
			"%som%"=>$som,
			"%serial%"=>$serial
		],
	"festa" => [
		"%endereco_festa%" => $endereco_festa,
		"%cidade_festa%" => $cidade_festa,
		"%uf_festa%" => $uf_festa,
		"%cep_festa%" => $cep_festa,
		"%data_evento%" => $data_evento,
		"%data_hora_entrega%" => $data_hora_entrega,
		"%data_hora_devolucao%" => $data_hora_devolucao,
		"%diaria_quantidade%" => $diaria_quantidade,
		"%valor%" => $valor,
		"%valor_extenso%" => $valor_extenso	
		]
	];

    $contrato = '
	"%codigo_contrato%",
	"%nome%",
	"%cpf_cnpj%",
	"%doc%",
	"%nome_razao%",
	"%telefone%",
	"%endereco%",
	"%cidade%",
	"%uf%",
	"%cep%",
	"%email%",
	"%endereco_festa%",
	"%cidade_festa%",
	"%uf_festa%",
	"%cep_festa%",
	"%data_evento%",
	"%data_hora_entrega%",
	"%data_hora_devolucao%",
	"%diaria_quantidade%",
	"%valor%",
	"%valor_extenso%",
	"%data_contrato%",
	"%musicas%",
	"%tv%",
	"%som%",
	"%serial%"
	';
    $contrato = strtr($contrato,$variaveis['contrato']);
    $contrato = strtr($contrato,$variaveis['cliente']);
    $contrato = strtr($contrato,$variaveis['itens']);
	
	
	$html = strtr($contrato,$variaveis['festa']);
	
	echo $html;

	
	


?>
