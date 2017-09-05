<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 31/08/2017
 * Time: 17:27
 */

namespace util;


use Exception;
use Mustache_Engine;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    private $assunto;
    private $para;
    private $template;
    private $variaveisTemplate;


    /**
     * @param mixed $assunto
     */
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
    }

    /**
     * @param mixed $para
     */
    public function setPara($para)
    {
        $this->para = $para;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @param mixed $variaveisTemplate
     */
    public function setVariaveisTemplate($variaveisTemplate)
    {
        $this->variaveisTemplate = $variaveisTemplate;
    }


    /**
     * @return bool
     * @throws Exception
     * @internal param array $para
     * @internal param string $assunto
     * @internal param string $caminhoTemplate
     * @internal param array $variaveisTemplate
     */
    final function enviar()
    {
        $mail = new PHPMailer(true);
        try {
            if($this->para == ""){
                throw new Exception("Parâmetro \"para\" não foi passado.");
            }
            if(gettype($this->para) != "array"){
                throw new Exception("Parâmetro \"para\" deve ser um arrai contendo
                 as indexes \"email\" e \"para\"");
            }
            if($this->assunto == "") {
                throw new Exception("Parâmetro \"assunto\" não foi passado");
            }
            if($this->template == "") {
                throw new Exception("Parâmetro \"template\" não foi passado");
            }
            if($this->variaveisTemplate == "") {
                throw new Exception("Parâmetro \"variáveis do template\" não foi passado");
            }
            //Configurações do servidor SMTP
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
            $mail->addAddress($this->para['email'], $this->para['nome']);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $this->assunto;
            $mail->Body = $this->compileLayout($this->template, $this->variaveisTemplate);
            $mail->AltBody = 'Email automático.';

            $mail->send();
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $caminhoTemplate
     * @param array $variables
     * @return string
     */
    private function compileLayout($caminhoTemplate, array $variables)
    {
        $mustache = new Mustache_Engine;
        return utf8_decode($mustache->render($this->returnStringTemplate($caminhoTemplate), $variables));
    }

    /**
     * @param $caminhoTemplate
     * @return bool|string
     */
    private function returnStringTemplate($caminhoTemplate)
    {
        return file_get_contents($caminhoTemplate);
    }
}

//include_once '../vendor/autoload.php';
//
//$mail = new Mail();
//$mail->setAssunto("Migão bão");
//$mail->setPara(["email"=>"walysongomes.98@hotmail.com.br","nome"=>"Walyson Gomes"]);
//$mail->setTemplate("../templates/novo-usuario/index.html");
//$mail->setVariaveisTemplate(["nomepessoa"=>"Walyson Gomes"]);
//$mail->enviar();
