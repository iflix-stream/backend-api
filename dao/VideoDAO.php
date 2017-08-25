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

    /**
     * @var Video
     */
    private $video;

    function __construct($video)
    {
        $this->video = $video;
    }

    public static function create($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        $criteria->create();
        echo $criteria->show();
    }

    /**
     * @param Video $video
     * @return string
     */
    public static function retreave($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);

        $restrictions[0] = $criteria->restrictions()
            ->equals("ativado", '1');
        if ($video->getId() != null) {
            $restrictions[1] = $criteria->restrictions()
                ->equals("id", $video->getId());
        }
        if ($video->getNome() != null) {
            $restrictions[2] = $criteria->restrictions()
                ->like("nome", $video->getNome());
        }
        if ($video->getGenero() != null) {
            $restrictions[3] = $criteria->restrictions()
                ->equals("genero", $video->getGenero());
        }

        $restrictions = array_values($restrictions);
        if (count($restrictions) > 1) {
            $i = 0;
            $array =[];
            $string = "";
            while ($i < count($restrictions) - 1) {
                $array = $criteria->restrictions()
                    ->and($restrictions[$i], $restrictions[$i + 1]);
                $string .= $array['where'];
                $i = $i + 2;
            }
            $string = str_replace(')(',' AND ',$string);
            $array['where']= $string;
            $criteria->add($array);
        } else {
            if (!empty($restrictions)) {
                $criteria->add($restrictions[0]);
            }
        }
        $criteria->select();
        return $criteria->show();
    }

    /**
     * @param Video $video
     * @return bool
     */
    function update($video)
    {
        $phiber = new Phiber();
        $criteria = $phiber->openPersist($video);
        $restrictionID = $criteria->restrictions()->equals("id", $video->getId());
        $criteria->add($restrictionID);
        if ($criteria->update()) {
            return true;
        }
        return false;
    }
}