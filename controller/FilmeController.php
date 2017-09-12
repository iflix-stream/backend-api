<?php
/**
 * Created by PhpStorm.
 * User: ifgoianoadmin
 * Date: 11/09/2017
 * Time: 21:37
 */

namespace controller;


use model\Filme;
use util\DataConversor;
use view\View;
use model\validator\FilmeValidate;

class FilmeController implements Controller
{

    public function post()
    {
        $data = new DataConversor();
        $data = $data->converter();
        $validate = new FilmeValidate();
        $filme = new Filme();
        if (!isset($data['id'])) { // verifica se tem upload no post se tiver seta e salva se nao e porque ele quer colocar o link;
            $validate = $validate->validaUploadFilme($data);
            if ($validate === true) {
                $filme->setNome($data['nome']);
                $filme->setDescricao($data['descricao']);
                $filme->setGenero($data['genero']);
                $filme->setFormato($data['formato']);
                $filme->setClassificacao($data['idade_recomendada']);
                $filme->cadastrar();
            } else {
                View::render($validate);
            }
        } else {
            $caminho = $filme->fazerUpload($filme->getTipo(), $filme->getNome());
            if (is_string($caminho)) {
                $filme->setCaminho($caminho);
                $filme->setId($data['id']);
                $filme->alterar();
            }
        }
    }

    public function get($params = [])
    {
        $filme = new Filme();

        if (isset($params['id'])) $filme->setId($params['id']);
        if (isset($params['nome'])) $filme->setNome($params['nome']);
        if (isset($params['genero'])) $filme->setGenero($params['genero']);
        $data = ["SQL" => "" . $filme->listar() . ""];
        if ($_GET['stream'] == "true") {
            $filme->setId($_GET['id']);
            $filme->stream();
        }
        View::render($data);
    }

    public function put()
    {
        // TODO: Implement put() method.
    }

    public function delete()
    {
        // TODO: Implement delede() method.
    }
}