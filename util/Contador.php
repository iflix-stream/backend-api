<?php

namespace util;

class Contador
{

    public $caminho = './contagem.txt';
    private $file;
    private $numero;

    public function __construct()
    {
        $this->file = new Arquivo();
        $this->file->setPath('./contagem.txt');
        if (!file_exists($this->file->getPath())) {
            $this->file->create();
            $this->file->write("0");
        }
        $this->numero = $this->file->read();
    }

    public function somar()
    {
        $this->file->write((int)$this->numero + 1);
        return $this->file->read();
    }

    public function subtrair()
    {
        $this->file->write((int)$this->numero - 1);
        return $this->file->read();
    }
}
