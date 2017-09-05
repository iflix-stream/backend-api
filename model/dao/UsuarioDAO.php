<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/08/2017
 * Time: 17:10
 */

namespace model\dao;


use model\Usuario;
use phiber\bin\persistence\PhiberPersistence;
use phiber\Phiber;
use util\Mensagem;


class UsuarioDAO implements IDAO
{
    private $usuario;
    private static $rows;


    /**
     * @return mixed
     */
    public static function getRows()
    {
        return self::$rows;
    }


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

        if ($usuario->getId() != null and $usuario->getNome() == null) {
            return self::retreaveById($usuario);
        }

        if ($usuario->getId() == null and $usuario->getNome() != null) {
            return self::retreaveByName($usuario);
        }

        if ($usuario->getId() == null and $usuario->getNome() == null) {
            return self::retreaveLimit15($usuario);
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
        $restriction = $criteria->restrictions()->and($restrictionStatus, $restrictionEmail);
        $criteria->add($restriction);

        $r = $criteria->select();
        self::$rows = $criteria->rowCount();
        return $r;
    }


    /**
     * @param Usuario $usuario
     * @return array
     */
    private static function retreaveById($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        $restrictionID = $criteria->restrictions()->equals("id", $usuario->getId());
        $restrictionAtivado = $criteria->restrictions()->equals("status", '1');
        $restrictionAtivadoID = $criteria->restrictions()->and($restrictionAtivado, $restrictionID);
        $criteria->add($restrictionAtivadoID);
        $r = $criteria->select();
        self::$rows = $criteria->rowCount();
        return $r;
    }

    /**
     * @param Usuario $usuario
     * @return array
     */
    public static function retreaveByEmail($usuario)
    {
        if ($u = self::retreaveByEmail($usuario)) {
            if (password_verify($usuario->getSenha(), $u['senha'])) {

                $phiber = new Phiber();
                $criteria = $phiber->openPersist($usuario);
                $restrictionEmail = $criteria->restrictions()->equals("email", $usuario->getEmail());
                $restrictionAtivado = $criteria->restrictions()->equals("status", '1');
                $restrictionAtivadoEmail = $criteria->restrictions()->and($restrictionAtivado, $restrictionEmail);
                $criteria->add($restrictionAtivadoEmail);
                $r = $criteria->select();
                self::$rows = $criteria->rowCount();
                return $r;
            }
        }

    }

    /**
     * @param Usuario $usuario
     * @return array
     */
    private static function retreaveByName($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
        $restrictionName = $criteria->restrictions()->like("nome", $usuario->getNome());
        $restrictionAtivado = $criteria->restrictions()->equals("status", '1');
        $restrictionAtivadoName = $criteria->restrictions()->and($restrictionAtivado, $restrictionName);
//        $criteria->returnArray(true);
        $criteria->add($restrictionAtivadoName);


        return $criteria->select();
    }

    private static function retreaveLimit15($usuario)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($usuario);
//        $criteria->add($criteria->restrictions()->limit(15));
        $criteria->returnArray(true);
        $r = $criteria->select();
        echo $criteria->show();
        return $r;
    }

}