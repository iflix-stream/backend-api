<?php
namespace util;

class Contador
{

    public $caminho = './contagem.txt';

    public function somar()
    {
        $fp = fopen($this->caminho, 'r');
        $numero = (fread($fp, filesize($this->caminho)));
        fclose($fp);
        $fp = fopen($this->caminho, 'w');
        fwrite($fp, (int)$numero + 1);
        fclose($fp);
    }

    public function subtrair()
    {
        $fp = fopen($this->caminho, 'r');
        $numero = (fread($fp, filesize($this->caminho)));
        fclose($fp);
        if ((int)$numero != 0) {
            $fp = fopen($this->caminho, 'w');
            fwrite($fp, (int)$numero - 1);
            fclose($fp);
        }
    }
}
