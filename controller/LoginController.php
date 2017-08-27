<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 16:58
 */

namespace controller;


use model\Login;
use view\View;
class LoginController
{
  public $login;
    public function __construct($parametrosHttp = [])
    {
        $this->login = new Login();
        $this->login();

    }
    public function login(){
        $data =["SQL"=>"".$this->login->login().""];
        View::render($data);
    }
}