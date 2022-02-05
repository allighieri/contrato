-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 05-Fev-2022 às 17:24
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `videoke`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aparelhos`
--

DROP TABLE IF EXISTS `aparelhos`;
CREATE TABLE IF NOT EXISTS `aparelhos` (
  `idAparelhos` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `serial` varchar(20) NOT NULL,
  `musicas` int(11) NOT NULL,
  `padrao` int(1) NOT NULL,
  PRIMARY KEY (`idAparelhos`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aparelhos`
--

INSERT INTO `aparelhos` (`idAparelhos`, `nome`, `modelo`, `serial`, `musicas`, `padrao`) VALUES
(1, 'VSK C', 'VSK 3.0', 'LNK52X', 11500, 1),
(2, 'VSK N', 'VSK 3.0', 'KDK1984XL', 10375, 0),
(3, 'VSK R', 'VSK 3.0', 'PJ0987626', 11887, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aparelhos_contrato`
--

DROP TABLE IF EXISTS `aparelhos_contrato`;
CREATE TABLE IF NOT EXISTS `aparelhos_contrato` (
  `idAparelhosContrato` int(11) NOT NULL AUTO_INCREMENT,
  `idAparelhos` int(11) NOT NULL,
  `idEventos` int(11) NOT NULL,
  `valorDiaria` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idAparelhosContrato`),
  KEY `idAparelhos` (`idAparelhos`),
  KEY `idEventos` (`idEventos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aparelhos_contrato`
--

INSERT INTO `aparelhos_contrato` (`idAparelhosContrato`, `idAparelhos`, `idEventos`, `valorDiaria`) VALUES
(1, 1, 16, '255.00'),
(2, 2, 15, '193.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `idCpfCnpj` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `email` varchar(150) NOT NULL,
  PRIMARY KEY (`idCliente`),
  KEY `idCpfCnpj` (`idCpfCnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `idCpfCnpj`, `nome`, `telefone`, `cep`, `endereco`, `bairro`, `cidade`, `UF`, `email`) VALUES
(2, 2, 'MARIA CONCEIÇÃO', '(61) 99253-0902', '72.878-060', 'RUA 08 QUADRA 37 COND BELLE STELLA G 201', 'PARQUE ESPLANADA II', 'VALPARAÍSO DE GOIÁS', 'GO', 'conceicao2022@gmail.com'),
(3, 3, 'DANIELE N CASTRO', '(61) 99434-6210', '72.878-060', 'RUA 8 QUADRA 37 COND BELLE STELLA G 201', 'PARQUE ESPLANADA II', 'VALPARAÍSO DE GOIÁS', 'GO', 'dnovaescastro@gmail.com'),
(9, 9, 'SULLIVAN DA SILVA SAURO', '(66) 66666-6666', '90.909-090', 'RUA ABIÇAL 950', 'FOSSIL ANTIGO', 'DINOSAURANTE', 'DS', 'agenciaolhardigital@gmail.com'),
(13, 13, 'WEDER MONTEIRO ARAUJO', '(61) 99253-0902', '72.987-098', 'RUA 08 LOTE 01', 'ESPLANADA II', 'VALPARAÍSO DE GOIÁS', 'GO', 'agenciaolhardigital@gmail.com'),
(18, 18, 'ALLIGHIERI SULLIVAN DA SILVA', '(43) 43434-3434', '99.999-999', 'RUA SEM NOME', 'BAIRRO SEM NOME', 'CIDADE SEM NOME', 'GO', 'agenciaolhardigital@gmail.com'),
(19, 19, 'TESTE DE NOVO NOVISSIMO', '(78) 78787-6776', '78.787-878', 'FHDSJFHAS KASJD H', 'SDJKD FHKASJD H', 'SDKJAFHSKJDA ', 'GO', 'agenciaolhardigital@gmail.com'),
(20, 20, 'TESTE DE EMAIL MINUSCULO', '(98) 89787-8787', '90.909-090', 'ENDEREÇO COM EMAIL MINUSCLO', 'SDFJASDFA K', 'DKSJFBSJ', 'BH', 'agenciaolhardigital@gmail.com'),
(21, 21, 'THATIANE FERNANDES RIBAS', '(61) 99305-9494', '78.787-878', 'NOVO ENDEREÇO CONTRATO', 'BAIRRO QUALQUER', 'DFKAJNSDKFJAHJ', 'GO', 'thathycsa@gmail.com'),
(22, 22, 'TOSQUELIO SILVA SAURA', '(24) 24242-2424', '24.242-424', 'UM LUGAR CHAMADO NOTHING HILL', 'NEVERLAND', 'PLANALCITY', 'GO', 'tosquelio@silva.com.sauro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contratos`
--

DROP TABLE IF EXISTS `contratos`;
CREATE TABLE IF NOT EXISTS `contratos` (
  `idContratos` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idEventos` int(11) NOT NULL,
  `idAparelhos` int(11) NOT NULL,
  `idStatus` int(11) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`idContratos`),
  KEY `idAparelhos` (`idAparelhos`),
  KEY `contrato_ibfk_2` (`idEventos`),
  KEY `idCliente` (`idCliente`),
  KEY `idStatus` (`idStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contratos`
--

INSERT INTO `contratos` (`idContratos`, `idCliente`, `idEventos`, `idAparelhos`, `idStatus`, `valor`, `data`) VALUES
(2, 18, 10, 2, 4, '350.00', '2022-01-31 00:36:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cpf_cnpj`
--

DROP TABLE IF EXISTS `cpf_cnpj`;
CREATE TABLE IF NOT EXISTS `cpf_cnpj` (
  `idCpfCnpj` int(11) NOT NULL AUTO_INCREMENT,
  `cpf_cnpj` varchar(30) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`idCpfCnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cpf_cnpj`
--

INSERT INTO `cpf_cnpj` (`idCpfCnpj`, `cpf_cnpj`, `data`) VALUES
(2, '975.026.851-21', '2022-01-27 00:18:07'),
(3, '022.718.871-35', '2022-01-27 15:01:17'),
(9, '28.684.944/0001-90', '2022-01-28 23:26:17'),
(13, '975.026.851-20', '2022-01-29 17:42:12'),
(18, '000.000.000-00', '2022-01-30 12:48:04'),
(19, '09.987.666/6554-33', '2022-01-30 12:53:54'),
(20, '009.900.909-99', '2022-01-30 12:56:45'),
(21, '729.058.081-87', '2022-01-31 15:10:50'),
(22, '242.424.242-24', '2022-02-05 14:21:22');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `idEventos` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `endereco` varchar(250) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `bairro` varchar(250) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `instalacao` datetime NOT NULL,
  `retirada` datetime NOT NULL,
  `idStatus` int(11) NOT NULL,
  PRIMARY KEY (`idEventos`),
  KEY `idCliente` (`idCliente`),
  KEY `idStatus` (`idStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`idEventos`, `idCliente`, `endereco`, `cep`, `bairro`, `cidade`, `uf`, `instalacao`, `retirada`, `idStatus`) VALUES
(10, 18, 'RUA SEM NOME', '99.999-999', 'BAIRRO', 'CIDADE DA FESTA', 'GO', '2022-01-31 09:00:00', '2022-02-01 10:30:00', 1),
(12, 21, 'FESTA NESSE ENDEREÇO', '09.988-898', 'AGUAS CLARAS', 'BRASILIA', 'DF', '2022-01-30 10:00:00', '2022-01-31 10:00:00', 1),
(15, 13, 'NÃO TEM ITENS NO ENDEREÇO', '90.909-090', 'NÃO TEM ITENS NO BAIRRO', 'NÃO TEM ITENS NA CIDADE', 'NI', '2022-02-03 17:30:00', '2022-02-04 17:30:00', 1),
(16, 9, 'MAIS END', '90.909-090', 'MAIS BAIRRO', 'MAIS CIDADE ', 'MC', '2022-02-25 10:00:00', '2022-02-26 10:00:00', 1),
(17, 22, 'QUADRA 02', '57.565-656', 'SETOR NORTE', 'PLANALTINA', 'GO', '2022-02-05 14:21:00', '2022-02-06 14:21:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

DROP TABLE IF EXISTS `itens`;
CREATE TABLE IF NOT EXISTS `itens` (
  `idItens` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(250) NOT NULL,
  `padrao` int(1) NOT NULL,
  `qtde` int(11) NOT NULL,
  PRIMARY KEY (`idItens`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`idItens`, `descricao`, `padrao`, `qtde`) VALUES
(6, 'Microfone sem fio original do Videokê', 1, 2),
(11, 'Carregador de pilhas AA/AAA', 0, 1),
(18, 'Pedestal para caixa de som', 0, 1),
(19, 'Pedestal para microfone', 1, 2),
(20, 'Tv Philips 32\"', 0, 1),
(22, 'Vassoura', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_contrato`
--

DROP TABLE IF EXISTS `itens_contrato`;
CREATE TABLE IF NOT EXISTS `itens_contrato` (
  `idItensContrato` int(11) NOT NULL AUTO_INCREMENT,
  `idItens` int(11) NOT NULL,
  `idEventos` int(11) NOT NULL,
  `qtde` int(2) NOT NULL,
  PRIMARY KEY (`idItensContrato`),
  KEY `itens_contrato_ibfk_1` (`idEventos`),
  KEY `idItens` (`idItens`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens_contrato`
--

INSERT INTO `itens_contrato` (`idItensContrato`, `idItens`, `idEventos`, `qtde`) VALUES
(1, 6, 16, 2),
(2, 19, 16, 2),
(5, 11, 15, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `idStatus` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`idStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`idStatus`, `nome`) VALUES
(1, 'Cadastrar Itens'),
(2, 'Cancelado'),
(3, 'Aguardando Dados'),
(4, 'Enviado'),
(5, 'Aceito'),
(6, 'Acontecendo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE IF NOT EXISTS `template` (
  `idTemplate` int(11) NOT NULL AUTO_INCREMENT,
  `nomeTemplate` varchar(50) NOT NULL,
  `template` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idTemplate`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `template`
--

INSERT INTO `template` (`idTemplate`, `nomeTemplate`, `template`, `data`) VALUES
(1, 'PADRÃO', '<h1>CONTRATO DE ALUGUEL DE VIDEOKÊ - %codigo_contrato%</h1><h2>IDENTIFICAÇÃO DAS PARTES CONTRATANTES</h2><h3>LOCATÁRIO:</h3><p><b>%nome_razao%:</b> %nome%</p><p><b>%doc%:</b> %cpf_cnpj%</p><p><b>Telefone:</b> %telefone%</p><p><b>Endereço:</b> %endereco% %cidade%-%uf%%cep%</p><p><b>Email:</b> %email%</p><p><br></p><p><b>LOCADOR: Weder Monteiro Araujo 975.026.851-20 MEI, CNPJ: 28.181.684/0001-94, QMSW 02 CONJ. D, LOJA 13A, SALA 01, SUDOESTE – BRASÍLIA-DF CEP: 70680-200</b>.</p><p><br></p><p><b>As partes acima identificadas têm, entre si, justo e acertado o presente Contrato de Aluguel de Aparelho Videokê, mais caixas de som, microfones e televisor, que se regerá pelas cláusulas seguintes e pelas condições descritas no presente.</b></p><h3>DO OBJETO DO CONTRATO</h3><p><b>Cláusula 1ª.</b> O presente contrato tem como OBJETO, a prestação de serviços de aluguel de Videokê e demais itens conforme Cláusula 2ª.</p><h3>DOS APARELHOS</h3><p><b>Cláusula 2ª.</b> O VIDEOKÊ é a marca registrada do karaokê da RAF Eletronics e consiste de um aparelho áudio visual, que emite som instrumental com exibição de legenda da música em aparelhos de Tv e projetores de imagens. Os aparelhos fornecidos nesta locação são discriminados abaixo:</p><ol><li>01 VIDEOKE VSK 3.0 da RAF Eletronics Serial Nº %serial%, com %musicas% músicas;</li><li>%som%</li><li>01 pedestal para caixa de som;</li><li>02 microfones sem fio original do karaokê descrito no item a) desta cláusula;</li><li>02 pedestais para microfone;</li><li>08 pilhas recarregáveis para microfone;</li><li>02 Listas de músicas impressas em ordem alfabética por intérprete;</li><li>%tv%</li></ol><h3>DOS DADOS DE RESERVA DO VIDEOKÊ</h3><p><b>Cláusula 3ª.</b> Dados para reserva fornecidos pelo LOCATÁRIO:</p><ol><li><b>Data do evento:</b> %data_evento%</li><li><b>Data e Hora da entrega e instalação dos equipamentos:</b> %data_hora_entrega%</li><li><b>Data e Hora da devolução dos equipamentos:</b> %data_hora_devolucao%</li><li>A duração dos serviços será de %diaria_quantidade%, a contar Data e Hora da entrega constante do item (b) desta cláusula. <br></li><li><b>Endereço da Festa:</b> %endereco_festa% %cidade_festa%-%uf_festa%%cep_festa%</li></ol><h3>AS OBRIGAÇÕES DAS PARTES</h3><p><b>Cláusula 4ª.</b> O LOCADOR se compromete a fazer a entrega e instalação dos aparelhos constantes da Cláusula 2ª no endereço fornecido pelo LOCATÁRIO constante da Cláusula 3ª item “e” e buscar o mesmo conforme Cláusula 3ª item “c”.</p><p><b>Cláusula 5ª.</b> O LOCATÁRIO deverá fornecer todas as condições técnicas para a fixação dos equipamentos no local do evento, como espaço físico para a fixação do mesmo. Entende-se por condições técnicas o seguinte:</p><ol><li>Espaço para colocação do aparelho de karaokê e caixas de som livre de trânsito de convidados, afim de evitar tropeços em cabos e equipamentos que possam machucar pessoas ou danificar aparelhos.</li><li>O valor nominal dos equipamentos (karaokê, microfones, caixa de som e televisão) até a data deste, é estimado em R$ 25.000,00. Fica o LOCATÁRIO responsável pela integridade dos mesmos. Devendo em caso de dano causado durante o período de locação, arcar com os custos de conserto ou reposição em até 48h.</li></ol><p><b>Cláusula 6ª</b>. O LOCADOR se compromete a ensinar e mostrar como montar e operar o aparelho de karaokê.</p><h3>DO PAGAMENTO</h3><p><b>Cláusula 7ª.</b>O LOCATÁRIO pagará ao LOCADOR a quantia de <b>Valor:</b> R$ %valor%,00 (%valor_extenso%), referente ao aluguel dos equipamentos constantes da Cláusula 2ª. </p><ol><li>O pagamento deverá ser feito em dinheiro ou PIX na Data e Hora da entrega dos equipamentos no evento, assim que os equipamentos estiverem instalados e testados.</li><li>A não devolução dos equipamentos na Data e Hora constantes da Cláusula 3ª, item (c) implicará na contratação de uma nova diária com pagamento integral conforme Cláusula 7ª, mais <b>multa no valor de 60% do valor do contrato</b>.<br></li></ol><h3>DA RESCISÃO</h3><p><b>Cláusula 8ª.</b> O LOCATÁRIO ou LOCADOR poderá cancelar a reserva sem custos desde que o cancelamento ocorra no prazo mínimo de 5 dias de antecedência a data do evento constante da Cláusula 3ª, item (a).</p><ol><li>Caso o cancelamento ocorra depois do prazo acima, deverá ser pago uma taxa no valor de 60% do valor da locação para a o LOCADOR caso o cancelamento ocorra por parte do LOCATÁRIO, ou para o LOCATÁRIO caso o cancelamento ocorra por parte do LOCADOR;</li><li>O LOCADOR poderá cancelar a reserva no local do evento caso as condições deste contrato não sejam atendidas.</li></ol><h3>DO ACEITE DO CONTRATO</h3><p><b>Cláusula 9ª.</b> Para aceitar os termos do contrato por e-mail o LACATÁRIO deverá responder o mesmo colocando no corpo da mensagem: “estou de acordo com os termos do contrato enviado anexo”.</p><h3>CONDIÇÕES GERAIS</h3><p><b>Cláusula 10ª.</b> Os convidados ou pessoas no evento não poderão pegar nos microfones com as mãos molhadas ou descalças para evitar choques as pessoas ou danos ao equipamento.</p><p><b>Cláusula 11ª.</b> Obrigam-se ao presente contrato as partes e seus sucessores.</p><h3>DO FORO</h3><p><b>Cláusula 12ª.</b> Para dirimir quaisquer controvérsias oriundas do CONTRATO, as partes elegem o foro de Brasília (DF).</p><p>E por estarem assim justos e contratados, firmam o presente instrumento, através do aceite conforme Cláusula 9ª.</p><p><br></p><p><br></p><p><br></p><p>Brasília, %data_contrato%.</p>', '2022-01-25 05:12:08'),
(6, 'TEMPLATE 05', '<h1>CONTRATO DE ALUGUEL DE VIDEOKÊ - %codigo_contrato%</h1><h2>IDENTIFICAÇÃO DAS PARTES CONTRATANTES</h2><h3>LOCATÁRIO:</h3><p><b>%nome_razao%:</b> %nome%</p><p><b>%doc%:</b> %cpf_cnpj%</p><p><b>Telefone:</b> %telefone%</p><p><b>Endereço:</b> %endereco% %cidade%-%uf%%cep%</p><p><b>Email:</b> %email%</p><p><b>LOCADOR: Weder Monteiro Araujo 975.026.851-20 MEI, CNPJ: 28.181.684/0001-94, QMSW 02 CONJ. D, LOJA 13A, SALA 01, SUDOESTE – BRASÍLIA-DF CEP: 70680-200</b>.</p><p><b>As partes acima identificadas têm, entre si, justo e acertado o presente Contrato de Aluguel de Aparelho Videokê, mais caixas de som, microfones e televisor, que se regerá pelas cláusulas seguintes e pelas condições descritas no presente.</b></p><h3>DO OBJETO DO CONTRATO</h3><p><b>Cláusula 1ª.</b> O presente contrato tem como OBJETO, a prestação de serviços de aluguel de Videokê e demais itens conforme Cláusula 2ª.</p><h3>DOS APARELHOS</h3><p><b>Cláusula 2ª.</b> O VIDEOKÊ é a marca registrada do karaokê da RAF Eletronics e consiste de um aparelho áudio visual, que emite som instrumental com exibição de legenda da música em aparelhos de Tv e projetores de imagens. Os aparelhos fornecidos nesta locação são discriminados abaixo:<br></p><p><br></p><ol><li>01 VIDEOKE VSK 3.0 da RAF Eletronics Serial Nº %serial%, com %musicas% músicas;</li><li>%som%</li><li>01 pedestal para caixa de som;</li><li>02 microfones sem fio original do karaokê descrito no item a) desta cláusula;</li><li>02 pedestais para microfone;</li><li>08 pilhas recarregáveis para microfone;</li><li>02 Listas de músicas impressas em ordem alfabética por intérprete;</li><li>%tv%</li></ol><h3>DOS DADOS DE RESERVA DO VIDEOKÊ</h3><p><b>Cláusula 3ª.</b> Dados para reserva fornecidos pelo LOCATÁRIO:</p><ol><li><b>Data do evento:</b> %data_evento%</li><li><b>Data e Hora da entrega e instalação dos equipamentos:</b> %data_hora_entrega%</li><li><b>Data e Hora da devolução dos equipamentos:</b> %data_hora_devolucao%</li><li>A duração dos serviços será de %diaria_quantidade%, a contar Data e Hora da entrega constante do item (b) desta cláusula. <br></li><li><b>Endereço da Festa:</b> %endereco_festa% %cidade_festa%-%uf_festa%%cep_festa%</li></ol><h3>AS OBRIGAÇÕES DAS PARTES</h3><p><b>Cláusula 4ª.</b> O LOCADOR se compromete a fazer a entrega e instalação dos aparelhos constantes da Cláusula 2ª no endereço fornecido pelo LOCATÁRIO constante da Cláusula 3ª item “e” e buscar o mesmo conforme Cláusula 3ª item “c”.</p><p><b>Cláusula 5ª.</b> O LOCATÁRIO deverá fornecer todas as condições técnicas para a fixação dos equipamentos no local do evento, como espaço físico para a fixação do mesmo. Entende-se por condições técnicas o seguinte:</p><ol><li>Espaço para colocação do aparelho de karaokê e caixas de som livre de trânsito de convidados, afim de evitar tropeços em cabos e equipamentos que possam machucar pessoas ou danificar aparelhos.</li><li>O valor nominal dos equipamentos (karaokê, microfones, caixa de som e televisão) até a data deste, é estimado em R$ 25.000,00. Fica o LOCATÁRIO responsável pela integridade dos mesmos. Devendo em caso de dano causado durante o período de locação, arcar com os custos de conserto ou reposição em até 48h.</li></ol><p><b>Cláusula 6ª</b>. O LOCADOR se compromete a ensinar e mostrar como montar e operar o aparelho de karaokê.</p><h3>DO PAGAMENTO</h3><p><b>Cláusula 7ª.</b>O LOCATÁRIO pagará ao LOCADOR a quantia de <b>Valor:</b> R$ %valor%,00 (%valor_extenso%), referente ao aluguel dos equipamentos constantes da Cláusula 2ª. </p><ol><li>O pagamento deverá ser feito em dinheiro ou PIX na Data e Hora da entrega dos equipamentos no evento, assim que os equipamentos estiverem instalados e testados.</li><li>A não devolução dos equipamentos na Data e Hora constantes da Cláusula 3ª, item (c) implicará na contratação de uma nova diária com pagamento integral conforme Cláusula 7ª, mais multa de 60% do valor do contrato.</li></ol><h3>DA RESCISÃO</h3><p><b>Cláusula 8ª.</b> O LOCATÁRIO ou LOCADOR poderá cancelar a reserva sem custos desde que o cancelamento ocorra no prazo mínimo de 5 dias de antecedência a data do evento constante da Cláusula 3ª, item (a).</p><ol><li>Caso o cancelamento ocorra depois do prazo acima, deverá ser pago uma taxa no valor de 60% do valor da locação para a o LOCADOR caso o cancelamento ocorra por parte do LOCATÁRIO, ou para o LOCATÁRIO caso o cancelamento ocorra por parte do LOCADOR;</li><li>O LOCADOR poderá cancelar a reserva no local do evento caso as condições deste contrato não sejam atendidas.</li></ol><h3>DO ACEITE DO CONTRATO</h3><p><b>Cláusula 9ª.</b> Para aceitar os termos do contrato por e-mail o LACATÁRIO deverá responder o mesmo colocando no corpo da mensagem: “estou de acordo com os termos do contrato enviado anexo”.</p><h3>CONDIÇÕES GERAIS</h3><p><b>Cláusula 10ª.</b> Os convidados ou pessoas no evento não poderão pegar nos microfones com as mãos molhadas ou descalças para evitar choques as pessoas ou danos ao equipamento.</p><p><b>Cláusula 11ª.</b> Obrigam-se ao presente contrato as partes e seus sucessores.</p><h3>DO FORO</h3><p><b>Cláusula 12ª.</b> Para dirimir quaisquer controvérsias oriundas do CONTRATO, as partes elegem o foro de Brasília (DF).</p><p>E por estarem assim justos e contratados, firmam o presente instrumento, através do aceite conforme Cláusula 9ª.</p><p>Brasília, %data_contrato%.</p>', '2022-01-30 01:38:36'),
(7, 'ITENS', '<h1>CONTRATO DE ALUGUEL DE VIDEOKÊ - %codigo_contrato%</h1><h2>IDENTIFICAÇÃO DAS PARTES CONTRATANTES</h2><h3>LOCATÁRIO:</h3><p><b>%nome_razao%:</b> %nome%</p><p><b>%doc%:</b> %cpf_cnpj%</p><p><b>Telefone:</b> %telefone%</p><p><b>Endereço:</b> %endereco% %cidade%-%uf%%cep%</p><p><b>Email:</b> %email%</p><p><br></p><p><b>LOCADOR: Weder Monteiro Araujo 975.026.851-20 MEI, CNPJ: 28.181.684/0001-94, QMSW 02 CONJ. D, LOJA 13A, SALA 01, SUDOESTE – BRASÍLIA-DF CEP: 70680-200</b>.</p><p><br></p><p><b>As partes acima identificadas têm, entre si, justo e acertado o presente Contrato de Aluguel de Aparelho Videokê, mais caixas de som, microfones e televisor, que se regerá pelas cláusulas seguintes e pelas condições descritas no presente.</b></p><h3>DO OBJETO DO CONTRATO</h3><p><b>Cláusula 1ª.</b> O presente contrato tem como OBJETO, a prestação de serviços de aluguel de Videokê e demais itens conforme Cláusula 2ª.</p><h3>DOS APARELHOS</h3><p><b>Cláusula 2ª.</b> O VIDEOKÊ é a marca registrada do karaokê da RAF Eletronics e consiste de um aparelho áudio visual, que emite som instrumental com exibição de legenda da música em aparelhos de Tv e projetores de imagens. Os aparelhos fornecidos nesta locação são discriminados abaixo:</p><p>%itens%<br></p><h3>DOS DADOS DE RESERVA DO VIDEOKÊ</h3><p><b>Cláusula 3ª.</b> Dados para reserva fornecidos pelo LOCATÁRIO:</p><ol><li><b>Data do evento:</b> %data_evento%</li><li><b>Data e Hora da entrega e instalação dos equipamentos:</b> %data_hora_entrega%</li><li><b>Data e Hora da devolução dos equipamentos:</b> %data_hora_devolucao%</li><li>A duração dos serviços será de %diaria_quantidade%, a contar Data e Hora da entrega constante do item (b) desta cláusula. <br></li><li><b>Endereço da Festa:</b> %endereco_festa% %cidade_festa%-%uf_festa%%cep_festa%</li></ol><h3>AS OBRIGAÇÕES DAS PARTES</h3><p><b>Cláusula 4ª.</b> O LOCADOR se compromete a fazer a entrega e instalação dos aparelhos constantes da Cláusula 2ª no endereço fornecido pelo LOCATÁRIO constante da Cláusula 3ª item “e” e buscar o mesmo conforme Cláusula 3ª item “c”.</p><p><b>Cláusula 5ª.</b> O LOCATÁRIO deverá fornecer todas as condições técnicas para a fixação dos equipamentos no local do evento, como espaço físico para a fixação do mesmo. Entende-se por condições técnicas o seguinte:</p><ol><li>Espaço para colocação do aparelho de karaokê e caixas de som livre de trânsito de convidados, afim de evitar tropeços em cabos e equipamentos que possam machucar pessoas ou danificar aparelhos.</li><li>O valor nominal dos equipamentos (karaokê, microfones, caixa de som e televisão) até a data deste, é estimado em R$ 25.000,00. Fica o LOCATÁRIO responsável pela integridade dos mesmos. Devendo em caso de dano causado durante o período de locação, arcar com os custos de conserto ou reposição em até 48h.</li></ol><p><b>Cláusula 6ª</b>. O LOCADOR se compromete a ensinar e mostrar como montar e operar o aparelho de karaokê.</p><h3>DO PAGAMENTO</h3><p><b>Cláusula 7ª.</b>O LOCATÁRIO pagará ao LOCADOR a quantia de <b>Valor:</b> R$ %valor%,00 (%valor_extenso%), referente ao aluguel dos equipamentos constantes da Cláusula 2ª. </p><ol><li>O pagamento deverá ser feito em dinheiro ou PIX na Data e Hora da entrega dos equipamentos no evento, assim que os equipamentos estiverem instalados e testados.</li><li>A não devolução dos equipamentos na Data e Hora constantes da Cláusula 3ª, item (c) implicará na contratação de uma nova diária com pagamento integral conforme Cláusula 7ª, mais multa de 60% do valor do contrato.</li></ol><h3>DA RESCISÃO</h3><p><b>Cláusula 8ª.</b> O LOCATÁRIO ou LOCADOR poderá cancelar a reserva sem custos desde que o cancelamento ocorra no prazo mínimo de 5 dias de antecedência a data do evento constante da Cláusula 3ª, item (a).</p><ol><li>Caso o cancelamento ocorra depois do prazo acima, deverá ser pago uma taxa no valor de 60% do valor da locação para a o LOCADOR caso o cancelamento ocorra por parte do LOCATÁRIO, ou para o LOCATÁRIO caso o cancelamento ocorra por parte do LOCADOR;</li><li>O LOCADOR poderá cancelar a reserva no local do evento caso as condições deste contrato não sejam atendidas.</li></ol><h3>DO ACEITE DO CONTRATO</h3><p><b>Cláusula 9ª.</b> Para aceitar os termos do contrato por e-mail o LACATÁRIO deverá responder o mesmo colocando no corpo da mensagem: “estou de acordo com os termos do contrato enviado anexo”.</p><h3>CONDIÇÕES GERAIS</h3><p><b>Cláusula 10ª.</b> Os convidados ou pessoas no evento não poderão pegar nos microfones com as mãos molhadas ou descalças para evitar choques as pessoas ou danos ao equipamento.</p><p><b>Cláusula 11ª.</b> Obrigam-se ao presente contrato as partes e seus sucessores.</p><h3>DO FORO</h3><p><b>Cláusula 12ª.</b> Para dirimir quaisquer controvérsias oriundas do CONTRATO, as partes elegem o foro de Brasília (DF).</p><p>E por estarem assim justos e contratados, firmam o presente instrumento, através do aceite conforme Cláusula 9ª.</p><p>Brasília, %data_contrato%.</p>', '2022-01-30 04:12:31');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aparelhos_contrato`
--
ALTER TABLE `aparelhos_contrato`
  ADD CONSTRAINT `aparelhos_contrato_ibfk_1` FOREIGN KEY (`idAparelhos`) REFERENCES `aparelhos` (`idAparelhos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aparelhos_contrato_ibfk_2` FOREIGN KEY (`idEventos`) REFERENCES `eventos` (`idEventos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idCpfCnpj`) REFERENCES `cpf_cnpj` (`idCpfCnpj`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`idAparelhos`) REFERENCES `aparelhos` (`idAparelhos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contratos_ibfk_2` FOREIGN KEY (`idEventos`) REFERENCES `eventos` (`idEventos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contratos_ibfk_3` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contratos_ibfk_4` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eventos_ibfk_2` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`);

--
-- Limitadores para a tabela `itens_contrato`
--
ALTER TABLE `itens_contrato`
  ADD CONSTRAINT `itens_contrato_ibfk_1` FOREIGN KEY (`idEventos`) REFERENCES `eventos` (`idEventos`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itens_contrato_ibfk_2` FOREIGN KEY (`idItens`) REFERENCES `itens` (`idItens`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
