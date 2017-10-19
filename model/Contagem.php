<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 19/10/2017
 * Time: 16:20
 */

namespace model;


use util\Contador;

class Contagem
{
    public function aumentar()
    {
        (new Contador())->somar();
    }

    public function diminuir()
    {
        (new Contador())->subtrair();
    }
}