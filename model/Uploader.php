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
     * @var MediaFactory
     */
    private $context;

    /**
     * @var array
     */
    private $file;

    /**
     * Uploader constructor.
     * @param MediaFactory $context
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
        return new Upload($this->file);
    }

}