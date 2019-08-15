<?php

namespace Mobilozophy\accessapiclient\Services\Api;

/**
 * Class Credentials
 * @author Jeffrey Wray <jwray@mobilozophy.com>
 * @package Mobilozophy\accessapiclient\Services\Api
 */
class Credentials
{
    public $token;
    public $headers;

    /**
     * Credentials constructor.
     * @param $username
     * @param $password
     * @param array $headers
     */
    public function __construct($token, $headers = array())
    {
        $this->token = $token;
        $this->headers  = $headers;
    }


    /**
     * @return array
     */
    public function getHeaders() {
        $function_headers = array_merge(['Access-Token'=>$this->token], $this->headers);
        return $function_headers;
    }
}
