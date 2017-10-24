<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 23/10/2017
 * Time: 19:55
 */

namespace model\dao;

use model\Lista;
use phiber\Phiber;
use util\IflixException;


class ListaDAO implements IDAO
{

    private static $rows;

    /**
     * @return mixed
     */
    public static function getRows()
    {
        return self::$rows;
    }


    /**
     * @param Lista $lista
     */
    static function create($lista)
    {


        $phiber = new Phiber();
        $phiber->setTable("minha_lista_" . $lista->getVideo()->getTipo());
        $phiber->setFields(["usuario_id", $lista->getVideo()->getTipo() . "_id"]);
        $phiber->setValues([$lista->getUsuario()->getId(), $lista->getVideo()->getId()]);
        if ($phiber->create()) {
            return true;
        };
        throw new IflixException("Algo de errado aconteceu com o ListaDAO");
    }

    /**
     * @param $lista
     */
    static function retreave($lista)
    {
        // TODO: Implement retreave() method.
    }

    /**
     * @param $lista
     */
    static function update($lista)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $lista
     */
    static function delete($lista)
    {
        $phiber = new Phiber();
        $phiber->setTable("minha_lista_" . $lista->getVideo()->getTipo());
        $restrictionIdVideo = $phiber->restrictions->equals($lista->getVideo()->getTipo() . "_id", $lista->getVideo()->getId());
        $restrictionUsuario = $phiber->restrictions->equals("usuario_id", $lista->getUsuario()->getId());
        $restriction = $phiber->restrictions->and($restrictionIdVideo, $restrictionUsuario);
        $phiber->add($restriction);
        $phiber->delete();
        echo $phiber->show();
    }

    static function retornaListaWhereVideoAndUsuario($lista)
    {
        $phiber = new Phiber();
        $phiber->setTable("minha_lista_" . $lista->getVideo()->getTipo());
        $restrictionIdVideo = $phiber->restrictions->equals($lista->getVideo()->getTipo() . "_id", $lista->getVideo()->getId());
        $restrictionUsuario = $phiber->restrictions->equals("usuario_id", $lista->getUsuario()->getId());
        $restriction = $phiber->restrictions->and($restrictionIdVideo, $restrictionUsuario);
        $phiber->add($restriction);

        $r = $phiber->select();
        self::$rows = $phiber->rowCount();
        return $r;
    }
}