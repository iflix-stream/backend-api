<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 16:11
 */

namespace model;


abstract class MediaFactory
{
    private $nome;
    private $descricao;
    private $genero;
    private $idadeRecomendada;
    private $formato;
    private $caminho;

    public abstract function listar();

    public abstract function cadastrar();

    public abstract function deletar();

    public abstract function alterar();
}