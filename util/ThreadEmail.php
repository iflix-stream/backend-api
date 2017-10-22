<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/10/2017
 * Time: 18:25
 */

namespace util;


use \Thread;

class ThreadEmail
{

    /**
     * @var Mail
     */
    private $mail;
    private $assunto;
    private $para;
    private $template;
    private $variaveisTemplate;

    function run()
    {
        $this->mail = new Mail();
        $this->mail->setAssunto($this->assunto);
        $this->mail->setPara($this->para);
        $this->mail->setTemplate($this->template);
        $this->mail->setVariaveisTemplate($this->variaveisTemplate);
    }


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

    public function enviar(){
        $this->mail->enviar();
    }

}