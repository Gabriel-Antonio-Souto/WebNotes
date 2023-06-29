<?php 

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-type: application/json; charset=utf-8");
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './lib/vendor/autoload.php';
    include_once("../../limpar.php");
    require_once('../../model/Usuario.php');
    
    session_start();

    $mail = new PHPMailer();

    $method = $_SERVER['REQUEST_METHOD'];

    switch($method) {
        case "POST":
            try {

                $email = $_POST['email_recuperar'];
                $link = "http://localhost:81/webnotes/senha?chave=$email";
                /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->Host       = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth   = true;
                $mail->Username   = '2e0f8b4b98770b';
                $mail->Password   = '44e3eb7aa67599';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 2525;

                $mail->setFrom('atendimento@webnotes.com', 'Recuperação de senha');
                $mail->addAddress($email, $_SESSION['nome']);

                $mail->isHTML(true);                             
                $mail->Subject = 'Recuperar senha';
                $mail->Body    = "Você solicitou alteração de senha.<br><br>link de recuperação de senha: <b>$link</a></b><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você acesse este link.<br><br>";
                $mail->AltBody = "Você solicitou alteração de senha.\n\nlink de recuperação de senha:  <b>$link</a></b> \n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você acesse este link.\n\n";

                $mail->send();

                $msg = ['status' => true, 'msg' => 'E-mail enviado com sucesso. Acesse a sua caixa de e-mail para recuperar a senha!'];

     
            } catch (Exception $e) {
               // echo "Erro: E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
                $msg = ['status' => false, 'msg' => 'E-mail não enviado'];

            }

            break;
        
    }
        
    $json = json_encode($msg);

    echo $json;


?>