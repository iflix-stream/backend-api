<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 21/10/2017
 * Time: 13:56
 */

namespace util;


use GuzzleHttp\Client;
use util\Settings;

class Request extends Client
{

    /**
     * Request constructor.
     * @internal param $guzzle
     */
    public function __construct()
    {
        parent::__construct(["base_uri" => Settings::URL_BASE_API]);
    }


}