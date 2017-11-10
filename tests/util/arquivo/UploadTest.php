<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 08/11/2017
 * Time: 09:16
 */

namespace tests\util\arquivo;
include '../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use util\Upload;

class UploadTest extends TestCase
{
    private $archive;

    /**
     * ArquivoTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->archive = new Upload(
            [
                "tmp_name" => "C:\\Users\\marci\\WebstormProjects\\iflix-app\\res\\screen\\android\\screen-hdpi-landscape.png",
                "name" => "screen-hdpi-landscape.png",
                "size" => "152315",
                "type" => "image/png"
            ]
        );

    }


    /**
     * @test
     */
    public function testCriaDiretorio()
    {
        $this->archive->setDestinationPath("./uploads");
        $func = $this->archive->createDir();
        self::assertEquals(true, $func);
    }


    /**
     * @test
     */
    public function testIsDir()
    {
        $this->archive->setDestinationPath("./uploads");
        self::assertEquals(true, $this->archive->isDirExists());
    }

    /**
     * @test
     */
    public function testMoveUploadedFile()
    {
        $this->archive->setDestinationPath("./uploads");
        self::assertEquals(true, $this->archive->moveUploadedFile());
    }


}
