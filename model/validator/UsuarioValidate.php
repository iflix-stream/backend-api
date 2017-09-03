<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 03/09/2017
 * Time: 18:14
 */

namespace model\validator;

use Valitron\Validator;

class UsuarioValidate
{
    public function validateLogin($params)
    {
        $v = new Validator($params);
        $v->rule('required', ['email', 'senha']);
        $v->rule('email', 'email');
        if ($v->validate()) {
            return true;
        } else {
            // Errors
            return $v->errors();
        }
    }
}