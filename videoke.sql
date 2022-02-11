-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Fev-2022 às 00:52
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
(1, 'N 10 MIL MUSICAS', 'VSK 3.0', 'S9F5Y35X', 10107, 0),
(2, 'C 11 MIL MUSICAS', 'VSK 3.0', 'S3D6449X', 11659, 1),
(3, 'RESERVA', 'VSK 3.0', 'S0F5H23L', 11692, 0);

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
(1, 2, 1, '300.00'),
(2, 2, 2, '550.00'),
(3, 3, 3, '350.00'),
(4, 1, 4, '300.00'),
(5, 2, 5, '350.00'),
(6, 1, 6, '350.00');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `idCpfCnpj`, `nome`, `telefone`, `cep`, `endereco`, `bairro`, `cidade`, `UF`, `email`) VALUES
(1, 1, 'LETÍCIA MAGALHÃES DA SILVA', '(61) 98191-2370', '73.040-113', 'QUADRA 11 CONJUNTO C CASA 41', 'SOBRADINHO', 'BRASÍLIA', 'DF', 'alty2009@hotmail.com'),
(2, 2, 'ANA LUIZA BRITO FERREIRA', '(61) 99929-2100', '71.680-366', 'CONDOMÍNIO PARQUE E JARDIM DAS PAINEIRAS, CASA 63, QUADRA 4', 'JARDIM BOTÂNICO', 'BRASÍLIA', 'DF', 'analunet@yahoo.com.br'),
(3, 3, 'CECÍLIA AKEMI KOBAYASHI', '(61) 98576-5304', '71.505-725', 'SHIN QL 5 CONJ 2 CASA 3', 'LAGO NORTE', 'BRASÍLIA', 'DF', 'cecilkoba@hotmail.com'),
(5, 5, 'WEMERSON DA SILVA', '(61) 98592-6361', '72.227-991', 'CH. RANCHO MINEIRO', 'NÚCLEO RURAL BOA ESPERANÇA', 'CEILÂNDIA', 'DF', 'ranchomineiroeb@gmail.com'),
(6, 6, 'ROLANDO LISBOA DO ROSÁRIO', '(61) 99968-7108', '73.403-521', 'CONDOMÍNIO MESTRE D\'ARMAS MÓDULO G CASA 18', 'PLANALTINA', 'BRASÍLIA', 'DF', 'rolandolisboa@yahoo.com.br'),
(7, 7, 'WEDER MONTEIRO ARAUJO', '(61) 99253-0902', '72.878-060', 'RUA 08 QUADRA 37 COND. BELLE STELLA G 201', 'PARQUE ESPLANADA II', 'VALPARAÍSO DE GOIÁS', 'GO', 'agenciaolhardigital@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cpf_cnpj`
--

INSERT INTO `cpf_cnpj` (`idCpfCnpj`, `cpf_cnpj`, `data`) VALUES
(1, '082.891.251-35', '2022-02-07 16:07:34'),
(2, '080.404.806-12', '2022-02-08 11:15:33'),
(3, '646.388.711-00', '2022-02-08 18:34:02'),
(5, '710.141.871-68', '2022-02-09 14:11:17'),
(6, '385.658.461-72', '2022-02-09 15:50:25'),
(7, '975.026.851-20', '2022-02-09 18:30:04');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`idEventos`, `idCliente`, `endereco`, `cep`, `bairro`, `cidade`, `uf`, `instalacao`, `retirada`, `idStatus`) VALUES
(1, 1, 'QUADRA 11 CONJUNTO C CASA 41', '73.040-113', 'SOBRADINHO', 'BRASÍLIA', 'DF', '2022-02-27 11:00:00', '2022-02-28 09:00:00', 4),
(2, 2, 'CONDOMÍNIO PARQUE E JARDIM DAS PAINEIRAS, CASA 63, QUADRA 4,', '71.680-366', 'JARDIM BOTÂNICO', 'BRASÍLIA', 'DF', '2022-02-26 11:00:00', '2022-02-28 10:00:00', 4),
(3, 3, 'SHIN QI 2 CONJUNTO 5 CASA 6', '71.510-050', 'LAGO NORTE', 'BRASÍLIA', 'DF', '2022-02-12 09:30:00', '2022-02-13 09:30:00', 4),
(4, 5, 'CH. RANCHO MINEIRO', '72.227-991', 'NÚCLEO RURAL BOA ESPERANÇA', 'CEILÂNDIA', 'DF', '2022-02-10 11:00:00', '2022-02-11 08:30:00', 4),
(5, 6, 'CONDOMÍNIO MESTRE D\'ARMAS MÓDULO G CASA 18', '73.403-521', 'PLANALTINA', 'BRASÍLIA', 'DF', '2022-03-05 11:00:00', '2022-03-06 10:00:00', 4),
(6, 7, 'QUADRA 07 MR 09 CASA 33', '72.752-107', 'SETOR LESTE', 'PLANALTINA', 'GO', '2022-02-25 10:00:00', '2022-02-26 10:00:00', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`idItens`, `descricao`, `padrao`, `qtde`) VALUES
(1, 'Caixa de som amplificada Stanner SR315A 300w Rms com entrada para pen drive e conexão bluetooth', 1, 1),
(2, 'Pedestal para caixa de som', 1, 1),
(3, 'Microfone sem fio original do karaokê descrito no item 1 desta cláusula', 1, 1),
(4, 'Pedestal para microfone', 1, 2),
(5, 'Pilha para microfone', 1, 4),
(6, 'Lista (catálogo) de músicas impressas em ordem alfabética por intérprete', 1, 2),
(7, 'Tv 32 Philips Modelo 32PHG4900/78”', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens_contrato`
--

INSERT INTO `itens_contrato` (`idItensContrato`, `idItens`, `idEventos`, `qtde`) VALUES
(14, 1, 1, 1),
(15, 2, 1, 1),
(16, 3, 1, 1),
(17, 4, 1, 2),
(18, 5, 1, 4),
(19, 6, 1, 2),
(20, 7, 1, 1),
(21, 1, 2, 1),
(22, 2, 2, 1),
(23, 3, 2, 1),
(24, 4, 2, 2),
(25, 5, 2, 4),
(26, 6, 2, 2),
(27, 7, 2, 1),
(28, 1, 3, 1),
(29, 2, 3, 1),
(30, 3, 3, 1),
(31, 4, 3, 2),
(32, 5, 3, 4),
(33, 6, 3, 2),
(34, 7, 3, 1),
(35, 1, 4, 1),
(36, 2, 4, 1),
(37, 3, 4, 1),
(38, 4, 4, 2),
(39, 5, 4, 4),
(40, 6, 4, 2),
(41, 7, 4, 1),
(42, 1, 5, 1),
(43, 2, 5, 1),
(44, 3, 5, 1),
(45, 4, 5, 2),
(46, 5, 5, 4),
(47, 6, 5, 2),
(48, 7, 5, 1),
(49, 1, 6, 1),
(50, 2, 6, 1),
(51, 3, 6, 1),
(52, 4, 6, 2),
(53, 5, 6, 4),
(54, 6, 6, 2),
(55, 7, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `idStatus` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`idStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`idStatus`, `nome`) VALUES
(1, 'Cadastrar Itens'),
(2, 'Cancelado'),
(3, 'Aguardando Dados'),
(4, 'Enviado'),
(5, 'Aceito'),
(6, 'Acontecendo'),
(8, 'Enviar');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `template`
--

INSERT INTO `template` (`idTemplate`, `nomeTemplate`, `template`, `data`) VALUES
(1, 'PADRÃO', '<h1>CONTRATO DE ALUGUEL DE VIDEOKÊ - %codigo_contrato%</h1><h2>IDENTIFICAÇÃO DAS PARTES CONTRATANTES</h2><h3>LOCATÁRIO:</h3><p><b>%nome_razao%:</b> %nome%</p><p><b>%doc%:</b> %cpf_cnpj%</p><p><b>Telefone:</b> %telefone%</p><p><b>Endereço:</b> %endereco%%bairro%%cidade%%uf%%cep%</p><p><b>Email:</b> %email%</p><p><b>LOCADOR: Weder Monteiro Araujo 975.026.851-20 MEI, CNPJ: 28.181.684/0001-94, QMSW 02 CONJ. D, LOJA 13A, SALA 01, SUDOESTE, BRASÍLIA-DF CEP: 70680-200</b>.</p><p><b><br></b></p><p><b>As partes acima identificadas têm, entre si, justo e acertado o presente Contrato de Aluguel de Aparelho Videokê e demais itens que se regerá pelas cláusulas seguintes e pelas condições descritas no presente.</b></p><p><b><br></b></p><h3>DO OBJETO DO CONTRATO</h3><p><b>Cláusula 1ª.</b> O presente contrato tem como OBJETO, a prestação de serviços de aluguel de Videokê e demais itens conforme Cláusula 2ª.</p><h3>DOS APARELHOS</h3><p><b>Cláusula 2ª.</b> O VIDEOKÊ é a marca registrada do karaokê da RAF Eletronics e consiste de um aparelho áudio visual, que emite som instrumental com exibição de legenda da música em aparelhos de Tv e projetores de imagens. Os demais itens fornecidos nesta locação são discriminados abaixo:</p><p><br></p><p>%itens%<br></p><h3>DOS DADOS DE RESERVA DO VIDEOKÊ</h3><p><b>Cláusula 3ª.</b> Dados para reserva fornecidos pelo LOCATÁRIO:</p><ol><li><b>Data do evento:</b> %data_evento%</li><li><b>Data e Hora da entrega e instalação dos equipamentos:</b> %data_hora_entrega%</li><li><b>Data e Hora da devolução dos equipamentos:</b> %data_hora_devolucao%</li><li>A duração do serviço será de %diaria_quantidade%, a contar Data e Hora da entrega constante do item \"2\" desta cláusula. <br></li><li><b>Endereço da Festa:</b> %endereco_festa%%bairro_festa%%cidade_festa%%uf_festa%%cep_festa%</li></ol><h3>AS OBRIGAÇÕES DAS PARTES</h3><p><b>Cláusula 4ª.</b> O LOCADOR se compromete a fazer a entrega e instalação dos aparelhos constantes da Cláusula 2ª no endereço fornecido pelo LOCATÁRIO constante da Cláusula 3ª item “5” e buscar o mesmo conforme Cláusula 3ª item “3”.</p><p><b>Cláusula 5ª.</b> O LOCATÁRIO deverá fornecer todas as condições técnicas para a fixação dos equipamentos no local do evento, como espaço físico para a fixação do mesmo. Entende-se por condições técnicas o seguinte:</p><ol><li>Espaço para colocação do aparelho de karaokê e caixas de som livre de trânsito de convidados, afim de evitar tropeços em cabos e equipamentos que possam machucar pessoas ou danificar aparelhos.</li><li>O valor nominal dos equipamentos (karaokê, microfones, caixa de som e televisão) até a data deste, é estimado em R$ 25.000,00. Fica o LOCATÁRIO responsável pela integridade dos mesmos. Devendo em caso de dano causado durante o período de locação, arcar com os custos de conserto ou reposição em até 48h.</li></ol><p><b>Cláusula 6ª</b>. O LOCADOR se compromete a ensinar e mostrar como montar e operar o aparelho de karaokê.</p><h3>DO PAGAMENTO</h3><p><b>Cláusula 7ª.</b>O LOCATÁRIO pagará ao LOCADOR o <b>Valor de:</b> R$ %valor% (%valor_extenso%), referente ao aluguel dos equipamentos constantes da Cláusula 2ª. </p><ol><li>O pagamento deverá ser feito em dinheiro ou PIX na Data e Hora da entrega dos equipamentos no evento, assim que os equipamentos estiverem instalados e testados.</li><li>A não devolução dos equipamentos na Data e Hora constantes da Cláusula 3ª, item \"3\" implicará na contratação de uma nova diária com pagamento integral conforme Cláusula 7ª, mais multa de 60% do valor do contrato.</li></ol><h3>DA RESCISÃO</h3><p><b>Cláusula 8ª.</b> O LOCATÁRIO ou LOCADOR poderá cancelar a reserva sem custos desde que o cancelamento ocorra no prazo mínimo de 5 dias de antecedência a data do evento constante da Cláusula 3ª, item \"1\".</p><ol><li>Caso o cancelamento ocorra depois do prazo acima, deverá ser pago uma taxa no valor de 60% do valor da locação para a o LOCADOR caso o cancelamento ocorra por parte do LOCATÁRIO, ou para o LOCATÁRIO caso o cancelamento ocorra por parte do LOCADOR;</li><li>O LOCADOR poderá cancelar a reserva no local do evento caso as condições deste contrato não sejam atendidas.</li></ol><h3>DO ACEITE DO CONTRATO</h3><p><b>Cláusula 9ª.</b> Para aceitar os termos do contrato por e-mail o LOCATÁRIO deverá responder o mesmo colocando no corpo da mensagem: “<b>estou de acordo com os termos do contrato enviado anexo</b>” ou qualquer outra frase de concordância com os termos deste.<br></p><h3>CONDIÇÕES GERAIS</h3><p><b>Cláusula 10ª.</b> Os convidados ou pessoas no evento não poderão pegar nos microfones com as mãos molhadas ou descalças para evitar choques as pessoas ou danos ao equipamento.</p><p><b>Cláusula 11ª.</b> Obrigam-se ao presente contrato as partes e seus sucessores.</p><h3>DO FORO</h3><p><b>Cláusula 12ª.</b> Para dirimir quaisquer controvérsias oriundas do CONTRATO, as partes elegem o foro de Brasília (DF).</p><p>E por estarem assim justos e contratados, firmam o presente instrumento, através do aceite conforme Cláusula 9ª.</p><p><br></p><p><br></p><p>Brasília, %data_contrato%.</p>', '2022-02-10 16:11:37');

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
