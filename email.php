<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

require_once('conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['idEventos'])){
	
	$idStatus = $_POST['id'];
	$idEventos = $_POST['idEventos'];
	
	
	$sql= "SELECT
			c.idCliente,
			c.nome,
			c.email,
			e.idEventos,
			e.idCliente,
			e.instalacao,
			e.idStatus
			FROM cliente as c
			INNER JOIN eventos as e ON c.idCliente = e.idCliente
			WHERE e.idEventos = :idEventos";
			$stmt = $pdo->prepare($sql);	
			$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);   
			$stmt->execute();	
			$total = $stmt->rowCount();	
			$linhasCliente = $stmt->fetch();		


	$instalacao = new DateTime(utf8_encode($linhasCliente['instalacao'])); // Pega o momento atual
	$instalacao = $instalacao->format('d m y');	

	$instalacaohora = new DateTime(utf8_encode($linhasCliente['instalacao'])); // Pega o momento atual
	$instalacaohora = $instalacaohora->format('H:i'); // Exibe no formato desejado	
		
	$nomeCliente = $linhasCliente['nome'];
	$nomeCliente = explode(" ", $nomeCliente);

	$sobrenome = $nomeCliente[1];
	$sobrenome = strlen($sobrenome);

	$nomeCliente = ($sobrenome <= 2) ? $nomeCliente[0]." ".$nomeCliente[2] : $nomeCliente[0]." ".$nomeCliente[1];


	$arquivo = $instalacao." CONTRATO VIDEOKE - ".$nomeCliente;

	$nomeCliente = $nomeCliente;

	$emailCliente = $linhasCliente['email'];



	$instalacaoExtenso = new DateTime(utf8_encode($linhasCliente['instalacao'])); // Pega o momento atual
	$instalacaoExtenso = $instalacaoExtenso->format('Y-m-d');	

	$instalacaoExtenso = strftime('%A, %d de %B de %Y', strtotime($instalacaoExtenso));


	$instalacaohora;

	$msg = '
		<p>Olá, <strong>'.$nomeCliente.'</strong>, sua reserva está agendada para <strong>'.$instalacaoExtenso.'</strong>, às <strong>'.$instalacaohora.'</strong>, conforme <strong>Contrato de Reserva de Serviços  de Videokê</strong> no corpo desta mensagem logo abaixo e anexo de igual teor.<p>
		<p>Caso esteja tudo certo, para aceitar e confirmar sua reserva, favor responder o e-mail com a seguinte frase: <strong>"Estou de acordo com os termos do contrato enviado anexo"</strong>.</p> 
		<br /><br />
	';

	
	if($linhasCliente['idStatus'] >= 4){
		try{
			// Instância do objeto PHPMailer
			$mail = new PHPMailer;

			// Configura para envio de e-mails usando SMTP
			$mail->isSMTP();

			// Servidor SMTP
			$mail->Host = 'smtp.gmail.com';

			// Usar autenticação SMTP
			$mail->SMTPAuth = true;

			// Usuário da conta
			$mail->Username = 'agenciaolhardigital@gmail.com';

			// Senha da conta
			$mail->Password = 'daniele92530902';

			// Tipo de encriptação que será usado na conexão SMTP
			$mail->SMTPSecure = 'ssl';

			// Porta do servidor SMTP
			$mail->Port = 465;

			// Informa se vamos enviar mensagens usando HTML
			$mail->IsHTML(true);

			// Email do Remetente
			$mail->From = 'agenciaolhardigital@gmail.com';

			// Nome do Remetente
			$mail->FromName = 'Videokê Clube';

			// Endereço do e-mail do destinatário
			$mail->addAddress($emailCliente, $nomeCliente);

			// Assunto do e-mail
			$mail->Subject = 'Contrato de Aluguel de Videokê';
			
			// set word wrap
			$mail->WordWrap   = 80;	
			
			//Responder para...
			$mail->AddReplyTo('agenciaolhardigital@gmail.com', 'Videokê Clube'); 	

			//Attachments
			$mail->addAttachment('contrato/pdf/tmp/'.$arquivo.'.pdf');

			$html = file_get_contents('contrato/html/tmp/'.$arquivo.'.html');

			// Mensagem que vai no corpo do e-mail
			$mail->Body = $msg;
			$mail->Body .= $html;
			$mail->CharSet = 'uft-8'; // Charset da mensagem (opcional)	 




				$mail->Send();
					
				$mail->ClearAllRecipients();
				$mail->ClearAttachments();
				
				$status = 1;			
				$erro = 'Contrato enviado com sucesso!';


				$sql = "UPDATE eventos SET idStatus = :idStatus WHERE idEventos = :idEventos";
				

				$idStatus = 4;
				$stmt = $pdo->prepare($sql);			
				$stmt->bindParam(':idEventos', $idEventos, PDO::PARAM_INT);
				$stmt->bindParam(':idStatus', $idStatus, PDO::PARAM_INT);			
				$ress = $stmt->execute();

						if($ress){	
							$status = 1;	
							$erro = 'Contrato enviado com sucesso!';
						}else{
							$status = 0;					
							$erro = "Erro ao alterar Status";
							return false;	
						}				
					

				$retorno = array('erro'=>$erro, 'status'=>$status);			
				echo json_encode($retorno, JSON_PRETTY_PRINT);	
				return false;

			
		} catch (phpmailerException $e) {
			
			$status = 0;			
			$erro = 'Erro ao enviar Email';
			$retorno = array('erro'=>$erro, 'status'=>$status);			
			echo json_encode($retorno, JSON_PRETTY_PRINT);	
			return false;				
			
			
			
		}	
		
	}
	
	
	
			$status = 0;			
			$erro = 'Você precisa gerar o contrato antes de enviar o email!';			
				

			$retorno = array('erro'=>$erro, 'status'=>$status);			
			echo json_encode($retorno, JSON_PRETTY_PRINT);	
			return false;	

}