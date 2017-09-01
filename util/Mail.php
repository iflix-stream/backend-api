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
    /**
     * @param array $para
     * @param string $assunto
     * @param string $caminhoTemplate
     * @param array $variaveisTemplate
     */
    final static function enviar(array $para, string $assunto, string $caminhoTemplate, array $variaveisTemplate)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 1;
            $mail->isSMTP();
            $mail->Host = 'mx1.hostinger.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alfred@ifapps-morrinhos.com';
            $mail->Password = 'mlro1215';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('alfred@ifapps-morrinhos.com', 'Alfred');
            $mail->addAddress($para['email'], $para['nome']);     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $assunto;
            $mail->Body = self::compileLayout($caminhoTemplate, $variaveisTemplate);
            $mail->AltBody = 'Email automático.';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    /**
     * @param $caminhoTemplate
     * @param array $variables
     * @return string
     */
    private final static function compileLayout($caminhoTemplate, array $variables)
    {
        $mustache = new \Mustache_Engine;
        return utf8_decode($mustache->render(self::returnStringTemplate($caminhoTemplate), $variables));
    }

    /**
     * @param $caminhoTemplate
     * @return bool|string
     */
    private final static function returnStringTemplate($caminhoTemplate)
    {
        return file_get_contents($caminhoTemplate);
    }
}

include_once '../vendor/autoload.php';
Mail::enviar(["email" => "marciioluucas@gmail.com", "nome" => "Márcio Lucas"],
    "Bem-vindo", "../templates/novo-usuario/index.html",
    ["nomepessoa" => "Márcio Lucas"]);
