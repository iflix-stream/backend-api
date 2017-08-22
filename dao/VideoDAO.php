<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/08/2017
 * Time: 16:25
 */

namespace dao;


use model\Video;
use phiber\Phiber;

class VideoDAO
{

    public static function create($obj)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($obj);
        $criteria->create();
        echo $criteria->show();
    }

    /**
     * @param Video $obj
     * @return array
     */
    public static function retreave($obj)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($obj);
        $criteria->returnArray(true);

        $restrictions[0] = $criteria->restrictions()
            ->equals("ativado", '1');

        if ($obj->getNome() != null) {
            $restrictions[1] = $criteria->restrictions()
                ->like("nome", $obj->getNome());
        }
        if ($obj->getGenero() != null) {
            $restrictions[2] = $criteria->restrictions()
                ->equals("genero", $obj->getGenero());
        }

        $restrictions = array_values($restrictions);
        if (count($restrictions) > 1) {
            for ($i = 0; $i < count($restrictions) - 1; $i++) {
                $criteria->add($criteria->restrictions()
                    ->and($restrictions[$i], $restrictions[$i + 1]));
            }
        } else {
            if (!empty($restrictions)) {
                $criteria->add($restrictions[0]);
            }
        }

        return $criteria->select();
    }
}