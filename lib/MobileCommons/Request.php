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
     * Webform URL for opt-in and opt-outs
     */
    const WEBFORM_URL = 'https://secure.mcommons.com/profiles/';

    /**
     * Authentication String
     */
    private $_authentication_string;

    /**
     * Company Key
     */
    private $_company_key;


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

        if (isset($config['company_key'])) {
            $this->_company_key = $config['company_key'];
        }

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
     * Company Key Getter
     *
     * @return string
     */
    public function getCompanyKey() {
        return $this->_company_key;
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
          CURLOPT_CONNECTTIMEOUT => 30,
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

        $xmlObject = simplexml_load_string($response);

        if ($xmlObject === false) {
            throw new Exception("Response: Response was not valid XML");
        }

        return $xmlObject;
    }

    /**
     * Make a request to the Web Form API.
     *
     * @param string $action
     * @param array $params
     * @param array $friends
     * @return string
     */
    public function webform($action, $params, $friends = array()) {
        $url = self::WEBFORM_URL . $action;
 
        $header = sprintf("Authorization: Basic %s\r\n", base64_encode($this->getAuthenticationString()));
        $header .= "Content-type: application/x-www-form-urlencoded\r\n";
        $params = http_build_query($params);

        // If we have any friends present:
        if (!empty($friends)) {
            // Loop through them.
            foreach ($friends as $friend) {
                // Add each one to the query string.
                $params .= '&friends[]=' . $friend;                
            }
        }

        $opts = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => $header,
                'content' => $params,
            )
        );
 
        $context = stream_context_create($opts);
        return file_get_contents($url, FALSE, $context);
    }
 
}
