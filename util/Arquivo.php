<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/11/2017
 * Time: 07:57
 */

namespace util;


use ArrayObject;
use Closure;
use DirectoryIterator;
use Exception;
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
        if (!isset($this->path))
            throw new InvalidArgumentException("Path not specified. Do you called setPath() before?");
        $fp = fopen($this->path, 'a+');
        fclose($fp);
        return $fp;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function write(string $value)
    {
        if (!isset($this->path))
            throw new InvalidArgumentException("Path not specified. Do you called setPath() before?");
        $fp = fopen($this->path, 'r+');
        $r = fwrite($fp, $value) ? true : false;
        fclose($fp);
        return $r;
    }

    /**
     * @return bool|string
     * @throws Exception
     */
    public function read()
    {
        if (!isset($this->path))
            throw new InvalidArgumentException("Path not specified. Do you called setPath() before?");
        if (!file_exists($this->path))
            throw new Exception("File don't exists");
        if (filesize($this->path) > 0) {
            $fp = fopen($this->path, "r");
            $r = fgets($fp, 1024);
            fclose($fp);
            return $r;
        }
        throw new Exception("Arquivo vazio.");
    }

    /**
     * @return bool
     */
    public function delete()
    {
        if (!isset($this->path))
            throw new InvalidArgumentException("Path not specified. Do you called setPath() before?");
        return unlink($this->path);
    }

    /**
     *
     */
    public function toList()
    {
        $types = array('png', 'jpg', 'jpeg', 'gif');
        $arrReturn = [];
        $dir = new DirectoryIterator($this->path);
        foreach ($dir as $fileInfo) {
            $ext = strtolower($fileInfo->getExtension());
            if (in_array($ext, $types)) array_push($arrReturn, ['file' => $fileInfo->getFilename()]);
        }
        return new ArrayObject($arrReturn);
    }
}