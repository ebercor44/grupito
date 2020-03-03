<?php include_once("bbdd/configuracion.php"); ?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

?>

<?php
//Función que enviará un email
function enviarEmail($nombre,$email,$asunto,$mensaje){

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
			//Server settings
			$mail->SMTPDebug = 2; //SMTP::DEBUG_SERVER;                       // Enable verbose debug output
			$mail->isSMTP();                                            			// Send using SMTP
			$mail->Host       = HOST_EMAIL;                    					// Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   			// Enable SMTP authentication
			$mail->Username   = USERNAME_EMAIL;                     		// SMTP username
			$mail->Password   = PASSWORD_EMAIL;                           // SMTP password 'pgyhxfdqzmxetojb'
			$mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = PORT_EMAIL;                                    			// TCP port to connect to

			//Recipients
			$mail->setFrom($email, $nombre);
			$mail->addAddress('ebercor44@gmail.com');               				// Name is optional
			$mail->addReplyTo($email, $nombre);
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			/*
			// Attachments
			$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			*/

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $asunto;
			$mail->Body    = $mensaje;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			$enviado=true;
			
	} catch (Exception $e) {
			echo "El mensaje no se pudo enviar. Mailer Error: {$mail->ErrorInfo}";
			$enviado=false;
	}
	return enviado;
	
} //fin enviarEmail
?>