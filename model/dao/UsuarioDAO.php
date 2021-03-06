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
use util\IflixException;
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
     * @return bool
     * @throws IflixException
     */
    static function create($usuario)
    {
        $phiber = new Phiber($usuario);
        if ($phiber->create()) {
            return true;
        }
        throw new IflixException("erro-criar-usuario", 500, true);
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
            return self::retreaveLimit15();
        }

        return (new Mensagem())->error("erro-retreave-usuario", 500);
    }

    /**
     * @param Usuario $usuario
     * @return boolean
     */
    static function update($usuario)
    {
        $phiber = new Phiber($usuario);
        $restrictionID = $phiber->restrictions->equals("id", $usuario->getId());
        $phiber->add($restrictionID);
        if ($phiber->update()) {
            return true;
        }
        return false;
    }


    /**
     * @param Usuario $usuario
     * @return string
     */
    static function delete($usuario)
    {
        $phiber = new Phiber($usuario);
        $usuario->setStatus(0);
        $restrictionID = $phiber->restrictions->equals("id", $usuario->getId());

        $phiber->add($restrictionID);
        if ($phiber->update()) {
            return $phiber->show();
        }
        return "Erro ao deletar o usuário:" . $usuario->getId();
    }

    /**
     * @param Usuario $usuario
     * @return mixed
     */
    static function login($usuario)
    {
        $phiber = new Phiber($usuario);
        $restrictionStatus = $phiber->restrictions->equals("status", 1);
        $restrictionEmail = $phiber->restrictions->equals("email", $usuario->getEmail());
        $restriction = $phiber->restrictions->and($restrictionStatus, $restrictionEmail);
        $phiber->add($restriction);

        $r = $phiber->select();
        self::$rows = $phiber->rowCount();
        return $r;
    }


    /**
     * @param Usuario $usuario
     * @return array
     */
    private static function retreaveById($usuario)
    {
        $phiber = new Phiber();
        $phiber->writeSQL("SELECT id,nome,email,avatar,isControleDosPais, dataNascimento
        FROM usuario WHERE status = :cond_status AND id = :cond_id");
        $phiber->bindValue("cond_status", 1);
        $phiber->bindValue("cond_id", $usuario->getId());
        $phiber->execute();
        self::$rows = $phiber->rowCount();
        return $phiber->fetch();
    }

    /**
     * @param Usuario $usuario
     * @return array|boolean
     */
    public static function retreaveByEmail($usuario)
    {
        $phiber = new Phiber();
//        $restrictionEmail = $phiber->restrictions->equals("email", $usuario->getEmail());
//        $restrictionAtivado = $phiber->restrictions->equals("status", '1');
//        $restrictionAtivadoEmail = $phiber->restrictions->and($restrictionAtivado, $restrictionEmail);
//        $phiber->setTable("usuario");
//        $phiber->setFields(["id", "nome", "email", "avatar", "isControleDosPais", "senha"]);
//        $phiber->add($restrictionAtivadoEmail);
//        $r = $phiber->select();
        $phiber->writeSQL("select id,nome,email,avatar,isControleDosPais,senha, dataNascimento
        from usuario WHERE status = :cond_status and email = :cond_email");
        $phiber->bindValue("cond_status",1);
        $phiber->bindValue("cond_email",$usuario->getEmail());
        $phiber->execute();
        self::$rows = $phiber->rowCount();
        return $phiber->fetch();
    }

    /**
     * @param Usuario $usuario
     * @return array
     */
    private static function retreaveByName($usuario)
    {
        $phiber = new Phiber();

        $restrictionName = $phiber->restrictions->like("nome", $usuario->getNome());
        $restrictionAtivado = $phiber->restrictions->equals("status", '1');
        $restrictionAtivadoName = $phiber->restrictions->and($restrictionAtivado, $restrictionName);
        $phiber->setTable("usuario");
        $phiber->setFields(["id", "nome", "email", "avatar", "isControleDosPais"]);
        $phiber->add($restrictionAtivadoName);


        return $phiber->select();
    }

    private static function retreaveLimit15()
    {
        $phiber = new Phiber();
        $phiber->setTable("usuario");
        $phiber->setFields(["id", "nome", "email", "avatar", "isControleDosPais"]);
        $phiber->add($phiber->restrictions->limit(15));
        $phiber->returnArray(true);
        $r = $phiber->select();
        return $r;
    }

}