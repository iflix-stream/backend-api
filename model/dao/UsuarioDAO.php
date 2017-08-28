<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:10
 */

namespace model\dao;


use model\Usuario;
use phiber\Phiber;


class UsuarioDAO implements IDAO
{
    private $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @param Usuario $usuario
     * @return string
     */
    static function create($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        if ($criteria->create()) {
            echo $criteria->show();
        }
        return "erro ao cadastrar usuário:" . $usuario->getId();
    }


    /**
     * @param Usuario $usuario
     * @return string
     */
    static function retreave($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        if ($usuario->getId() != null) {

            $restrictionID = $criteria->restrictions()->equals("id", $usuario->getId());
            $restrictionAtivado = $criteria->restrictions()->equals("ativado", '1');
            $restrictionAtivadoID = $criteria->restrictions()->and($restrictionAtivado, $restrictionID);
            $criteria->add($restrictionAtivadoID);
            $criteria->select();
            return $criteria->show();
        }
        return "Parametro ID nulo.";
    }

    /**
     * @param Usuario $usuario
     * @return string
     */
    static function update($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        $restrictionID = $criteria->restrictions()->equals("id", $usuario->getId());
        $criteria->add($restrictionID);
        if ($criteria->update()) {
            return $criteria->show();
        }
        return "erro ao alterar usuário:" . $usuario->getId();
    }


    /**
     * @param Usuario $usuario
     * @return string
     */
    static function delete($usuario)
    {
        $phiber = new Phiber();
        $usuario->setStatus(0);
        $criteria = $phiber->openPersist($usuario);
        $restrictionID = $criteria->restrictions()->equals("id", $usuario->getId());
        $criteria->add($restrictionID);
        if ($criteria->update()) {
            return $criteria->show();
        }
        return "Erro ao deletar o usuário:" . $usuario->getId();
    }

    static function login($login)
    {
        return $login;
    }

}