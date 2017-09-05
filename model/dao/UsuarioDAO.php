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
use util\Mensagem;


class UsuarioDAO implements IDAO
{
    private $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @param Usuario $usuario
     * @return array
     */
    static function create($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        if ($criteria->create()) {
            return Mensagem::success("sucesso-criar-usuario");
        }
        return Mensagem::error("erro-criar-usuario", 500);
    }


    /**
     * @param Usuario $usuario
     * @return array
     */
    static function retreave($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        if ($usuario->getId() != null) {

            $restrictionID = $criteria->restrictions()->equals("id", $usuario->getId());
            $restrictionAtivado = $criteria->restrictions()->equals("status", '1');
            $restrictionAtivadoID = $criteria->restrictions()->and($restrictionAtivado, $restrictionID);
            $criteria->add($restrictionAtivadoID);

            return $criteria->select();
        }
        return Mensagem::error("erro-retreave-usuario", 500);
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

    /**
     * @param Usuario $usuario
     * @return mixed
     */
    static function login($usuario)
    {
        $criteria = (new Phiber())->openPersist($usuario);
        $restrictionStatus = $criteria->restrictions()->equals("status", 1);
        $restrictionEmail = $criteria->restrictions()->equals("email", $usuario->getEmail());
        $restrictionSenha = $criteria->restrictions()->equals("senha", $usuario->getSenha());
        $restriction = $criteria->restrictions()->and($restrictionStatus,
            $criteria->restrictions()->and($restrictionEmail, $restrictionSenha));
        $criteria->add($restriction);
        $criteria->returnArray(false);
        $criteria->select();
        return $criteria->show();
    }

}