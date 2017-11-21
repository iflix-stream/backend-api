<?php
/**
 * @author Márcio Lucas Rezende de Oliveira <marciioluucas@gmail.com>
 * @copyright MIT
 * @link https://github.com/marciioluucas/file-uploader-php
 */

namespace util;


use Exception;
use InvalidArgumentException;

/**
 * Class Upload
 * @package util
 */
class Upload
{
    /**
     * @var mixed|string
     */
    private $tempName;
    /**
     * @var
     */
    private $destinationPath;
    /**
     * @var mixed|string
     */
    private $name;
    /**
     * @var mixed|string
     */
    private $size;
    /**
     * @var mixed|string
     */
    private $type;
    /**
     * @var mixed|string
     */
    private $error;

    /**
     * Upload constructor.
     * @param array $file
     */
    public function __construct(array $file)
    {
        $this->tempName = isset($file["tmp_name"]) ? $file["tmp_name"] : '';
        $this->name = isset($file["name"]) ? $file['name'] : '';
        $this->size = isset($file["size"]) ? $file['size'] : '';
        $this->type = isset($file["type"]) ? $file['type'] : '';
        $this->error = isset($file["error"]) ? $file['error'] : '';
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }


    /**
     * @return mixed
     */
    public function getDestinationPath()
    {
        return $this->destinationPath;
    }

    /**
     * @param mixed $destinationPath
     * @return $this
     */
    public function setDestinationPath($destinationPath)
    {
        $this->destinationPath = $destinationPath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTempName()
    {
        return $this->tempName;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        try {
            if ($this->moveUploadedFile()) {
                return $this->name;
            };
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function moveUploadedFile()
    {
        $this->createDir();
        $destino = $this->destinationPath;
        if (!move_uploaded_file($this->tempName, $this->destinationPath . basename($this->name))) {
            throw new InvalidArgumentException("The filename is not a valid upload file or cannot be moved for some reason.");
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function createDir()
    {
        if (!isset($this->destinationPath)) {
            throw new InvalidArgumentException("Destination path without value. Did you put a target folder with the setDestinationPath() method?");
        }
        if (!$this->isDirExists()) {
            if (!mkdir($this->destinationPath, 0777, true)) {
                throw new Exception("Error during create a directory");
            };
        }
        return true;
    }

    /**
     * @return bool
     */
    public function isDirExists()
    {
        if (!isset($this->destinationPath)) {
            throw new InvalidArgumentException("Destination path without value. Did you put a target folder with the setDestinationPath() method?");
        }
        return is_dir($this->destinationPath);
    }

}