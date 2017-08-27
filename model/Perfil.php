<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2017
 * Time: 13:52
 */

namespace model;


class Perfil
{
    private $id;
    private $nome;
    private $conteudoAdulto;
    private $avatar;
    private $ultimosAssistidos;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getConteudoAdulto()
    {
        return $this->conteudoAdulto;
    }

    /**
     * @param mixed $conteudoAdulto
     */
    public function setConteudoAdulto($conteudoAdulto)
    {
        $this->conteudoAdulto = $conteudoAdulto;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getUltimosAssistidos()
    {
        return $this->ultimosAssistidos;
    }

    /**
     * @param mixed $ultimosAssistidos
     */
    public function setUltimosAssistidos($ultimosAssistidos)
    {
        $this->ultimosAssistidos = $ultimosAssistidos;
    }

}