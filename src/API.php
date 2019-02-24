<?php

namespace Justify\VKAPI;

/**
 * Class API
 *
 * Class for interacting with VK API
 *
 * @package Justify\VKAPI
 */
class API
{
    /**
     * @var string your VK API access token
     */
    private $accessToken;

    /**
     * @var float version of VK API
     */
    private $version;

    /**
     * @var string method which will used
     */
    private $method = '';

    /**
     * API constructor.
     *
     * @param string $accessToken your VK API access token
     * @param float $version version of VK API
     */
    public function __construct($accessToken, $version)
    {
        $this->accessToken = $accessToken;
        $this->version = $version;
    }

    /**
     * Sends request for VK API and gets response
     *
     * @param string $method VK API method name
     * @param array $params params for request for VK API
     * @return object response from sent request
     * @throws \Justify\VKAPI\Exception
     */
    public function request($method, array $params = [])
    {
        $params['access_token'] = $this->accessToken;
        $params['v'] = $this->version;

        $params = http_build_query($params);
        $url = 'https://api.vk.com/method/' . $method . '?' . $params;

        $response = json_decode(file_get_contents($url));

        if (isset($response->error)) {
            throw new Exception($response->error->error_msg, $response->error->error_code);
        }

        return $response;
    }

    /**
     * Sets name of VK API object which will be used
     *
     * Returns self object. Use next the method of the VK API object for send request
     *
     * @param string $name name of VK API object
     * @return $this|mixed
     */
    public function __get($name)
    {
        $this->method = $name;

        return $this;
    }

    /**
     * Sends request for VK API
     *
     * @param string $name name of the VK API object method
     * @param array $arguments the 0 element is the array of request params
     * @return object|mixed
     * @throws \Justify\VKAPI\Exception
     */
    public function __call($name, array $arguments)
    {
        $this->method .= '.' . $name;

        return $this->request($this->method, $arguments[0]);
    }
}
