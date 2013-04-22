<?php

if (!function_exists('curl_init')) {
    throw new Exception('MobileCommons needs the CURL PHP extension.');
}

if (!function_exists('simplexml_load_string')) {
    throw new Exception('MobileCommons needs the SimpleXML PHP extension.');
}

require(dirname(__FILE__) . '/MobileCommons/Request.php');
require(dirname(__FILE__) . '/MobileCommons/MobileCommons.php');
