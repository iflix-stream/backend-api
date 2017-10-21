<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/10/2017
 * Time: 12:26
 */

namespace util;


use \Exception;

class IflixException extends Exception
{
    private $referencia;
    private $code;
    private $isTraduzir;

    public function __construct($referencia, $code = 0, $isTraduzir = false, Exception $previous = null)
    {
        $this->referencia = $referencia;
        $this->code = $code;
        $this->isTraduzir = $isTraduzir;
        parent::__construct($referencia, $code, $previous);

    }

    /**
     * @return array
     */
    public function retornaJsonMensagem()
    {
        return (new Mensagem())->exception($this->referencia, $this->code, $this->isTraduzir);
    }
}