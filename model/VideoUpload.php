<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 23/08/2017
 * Time: 13:25
 */

namespace model;

use util\SalvarArquivo;
use dao\VideoUploadDAO;
use view\View;

class VideoUpload extends MediaFactory
{

    public function listar()
    {
        // TODO: Implement listar() method.
    }

    public function cadastrar()
    {
        $caminho = $this->fazerUpload();
        if (is_string($caminho)) {
            $this->setCaminho($caminho);
            VideoUploadDAO::create($this);
        } else {
            View::render(array("Mesagem"=>"Não foi possivel mover"));
        }
    }

    public function deletar()
    {
        // TODO: Implement deletar() method.
    }

    public function alterar()
    {
        // TODO: Implement alterar() method.
    }

    public function fazerUpload()
    {
        $salvar = new SalvarArquivo();
        return $salvar->salvaArquivo("Video", "arquivo");
    }
}