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