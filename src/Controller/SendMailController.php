<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class SendMailController
{

    #[Route('/api/sendMail', name: 'sendMail', methods: ['POST'])]
    public function sendMail(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $to = $data['to'] ?? null;
        //$subject = $data['subject'] ?? null;
        $subject = "code authentification";
        $body = file_get_contents('..\templates\mail.html');
        //$body = $data['body'] ?? null;

        if (!$to || !$subject || !$body) {
            return new JsonResponse(['error' => 'Missing parameters.'], 400);
        }
        
        $user = $_ENV['USER'];
        $password = $_ENV['PASSWORD'];
        $host = $_ENV['HOST'];
        $port = $_ENV['PORT'];
        $sender = $_ENV['SENDER'];

        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $host;                  //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $user;                              //SMTP username
        $mail->Password   = $password;                            //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($sender, 'P-fast');
        $mail->addAddress($to, 'User');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        return new JsonResponse(['message' => 'E-mail sent successfully.'], 200);
    }
}
