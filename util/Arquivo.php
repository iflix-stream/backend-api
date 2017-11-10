<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/11/2017
 * Time: 07:57
 */

namespace util;


use Closure;
use InvalidArgumentException;

/**
 * Class Arquivo
 * @package util
 */
class Arquivo
{
    /**
     * string @var
     */
    private $path;

    /**
     * @var Closure
     */
    private $file;

    /**
     * Arquivo constructor.
     */
    public function __construct()
    {
        if (!isset($this->path))
            throw new InvalidArgumentException("Path not specified. Do you called setPath() before?");
        $this->file = function (string $mode = 'w') {
            return fopen($this->path, $mode);
        };
    }


    /**
     * @return string mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function create()
    {

        return $this->file->call($this, 'a') ? true : false;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function write(string $value)
    {
        return fwrite($this->file->call($this, 'w'), $value) ? true : false;
    }

    /**
     * @return bool|string
     */
    public function read()
    {
        return (fread($this->file->call($this, 'r'), filesize($this->path)));
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return unlink($this->path);
    }
}