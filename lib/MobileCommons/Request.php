<?php

/*
 * Request
 * This classes handles the HTTP requests responsible for making
 * API calls to the MobileCommons API.
 */

class Request
{
	/**
     * Base URL
     */
    const API_URL = 'https://secure.mcommons.com/api/';

	/**
     * Authentication String
     */
    private $_authentication_string;


	/**
     * Constructor
     *
     * @param array $base_url
     * @return void
     */
    public function __construct($config)
    {

    	//@todo - write test
        if (!is_array($config)) {
            throw new Exception("Configuration:  Missing configuration.");
        }

        //@todo - write test
        if (!isset($config['username']) || $config['username'] == '') {
            throw new Exception("Configuration: Missing username.");
        }

        //@todo - write test
        if (!isset($config['password']) || $config['password'] == '') {
            throw new Exception("Configuration: Missing password.");
        }

        $this->_setAuthenticationString($config['username'], $config['password']);

    }

    /**
     * Authentication String Setter
     *
     * @param string  $username
     * @param string  $password
     * @return void
     */
    private function _setAuthenticationString($username, $password)
    {
        $this->_authentication_string = $username . ':' . $password;
    }

    /**
     * Authentication String Getter
     *
     * @return string
     */
    public function getAuthenticationString()
    {
        return $this->_authentication_string;
    }

     /**
     * Make an api request
     *
     * @param string $resource
     * @param array $params
     * @param string $method
     */
    public function call($resource, $params = array(), $method = 'GET')
    {
        if (!empty($params) && is_array($params)) {
          $queryString = http_build_query($params);
        }
        else {
          $queryString = '';
        }

        $requestUrl = self::API_URL . $resource . ((strtolower($method) == 'get') ? '?' . $queryString : '');

        $curl = curl_init();

        $curl_options = array(
          CURLOPT_USERPWD => $this->getAuthenticationString(),
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $requestUrl,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTPHEADER => array('Accept: application/xml'),
        );

        if (strtolower($method) == 'post') {
          $curl_options[CURLOPT_POST] = 1;
          $curl_options[CURLOPT_POSTFIELDS] = $params;
        }

        curl_setopt_array($curl, $curl_options);
        $response = curl_exec($curl);
        $curl_info = curl_getinfo($curl);

        //@todo test for curl error
        if ($response === FALSE) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        curl_close($curl);


        //@todo test for any non 200 response
        if ($curl_info['http_code'] != 200) {
            throw new Exception("Response: Bad response - HTTP Code:". $curl_info['http_code']);
        }

        return $this->_response($response);
    }

    /**
     * Response
     *
     * @param string $xmlResponse
     * @return array
     */
    private function _response($xmlResponse)
    {
        //@todo write test for this
        if ( !($xmlObject = simplexml_load_string($xmlResponse)) ) {
          throw new Exception("Response: Response string is not XML");
        }

        //@todo write test to make sure this returns an array
        return $xmlObject;
    }

}