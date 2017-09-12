<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 12/09/2017
 * Time: 16:39
 */

namespace model\validator;

use Valitron\Validator;
class FilmeValidate
{
    public function validaUploadFilme($params){
        $v = new Validator($params);
        $v->rule('required',['nome','descricao','genero','idade_recomendada']);
        $v->rule('integer','idade_recomendada');
        if ($v->validate()) {
            return true;
        } else {
            // Errors
            return $v->errors();
        }
    }
}