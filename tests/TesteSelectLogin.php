<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 29/08/2017
 * Time: 14:32
 */

namespace tests;
include_once '../vendor/autoload.php';

use model\Usuario;
use PHPUnit\Framework\TestCase;

class TesteSelectLogin extends TestCase
{
    function testSelectLogin()
    {
        $usuario = new Usuario();
        $usuario->setStatus(1);
        $usuario->setEmail('marciioluucas@gmail.com');
        $usuario->setSenha('123');
        self::assertEquals('SELECT * FROM usuario  WHERE (status = :condition_status AND (email = :condition_email AND status = :condition_status)) ', $usuario->login());
    }
}
