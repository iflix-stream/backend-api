<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 16:58
 */

namespace dao;

use phiber\Phiber;
class LoginDAO
{
    private $login;

    public function __construct($login)
    {
        $this->login = $login;
    }
    static function login($login)
    {
        $phiber = new Phiber(); // trocar por um select
        $criteria = $phiber->openPersist($login);
        $criteria->create();
        return $criteria->show();
    }
}