<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/10/2017
 * Time: 13:52
 */

namespace controller;


use model\Email;
use util\DataConversor;

class EmailController implements IController
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $email = new Email();
        $email->setAssunto($data['assunto']);
        $email->setPara($data['para']);
        $email->setTemplate($data['template']);
        $email->setVariaveisTemplate($data['variaveisTemplate']);
        $email->enviar();
    }

    public function get($params = [])
    {
       json_encode(["asdasd"=>"aqui"]);
    }

    public function put($params = [])
    {
        // TODO: Implement put() method.
    }

    public function delete($params = [])
    {
        // TODO: Implement delete() method.
    }
}