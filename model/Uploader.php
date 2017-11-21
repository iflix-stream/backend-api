<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 20/11/2017
 * Time: 11:20
 */

namespace model;


use util\Upload;

class Uploader
{

    /**
     * @var Video
     */
    private $context;

    /**
     * @var array
     */
    private $file;

    /**
     * Uploader constructor.
     * @param Video $context
     * @param array $file
     */
    public function __construct($context, $file)
    {
        $this->context = $context;
        $this->file = $file;
    }


    /**
     *
     */
    public function upload()
    {
        $this->file['name'] = $this->context->getId().".mp4";
        return new Upload($this->file);
    }

}