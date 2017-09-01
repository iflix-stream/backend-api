<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 31/08/2017
 * Time: 17:27
 */

namespace util;


use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    final static function enviar($assunto, $caminhoTemplate, $variaveisTemplate)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 1;                                 // Enable verbose debug output
            $mail->isSMTP();
            $mail->Host = 'mx1.hostinger.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'alfred@ifapps-morrinhos.com';                 // SMTP username
            $mail->Password = 'mlro1215';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('alfred@ifapps-morrinhos.com', 'Alfred');
            $mail->addAddress('marciioluucas@gmail.com', 'Márcio Lucas');     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Teste';
            $mail->Body = self::compileLayout($caminhoTemplate, $variaveisTemplate);
            $mail->AltBody = 'Email automático.';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public final static function compileLayout($caminhoTemplate, array $variables)
    {
        $mustache = new \Mustache_Engine;
        return utf8_decode($mustache->render(self::returnStringTemplate($caminhoTemplate), $variables));
    }

    private final static function returnStringTemplate($caminhoTemplate)
    {
        return file_get_contents($caminhoTemplate);
    }
}

include_once '../vendor/autoload.php';
Mail::enviar("Bem-vindo","../templates/novo-usuario/index.html",["nomepessoa"=>"Márcio Lucas"]);
