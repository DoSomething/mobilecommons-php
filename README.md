[![Build Status](https://travis-ci.org/DoSomething/mobilecommons-php.png?branch=master)](https://travis-ci.org/DoSomething/mobilecommons-php)

Mobile Commons API Client for PHP by DoSomething.org
=========

A PHP wrapper for the Mobile Commons REST and mData API.

http://www.mobilecommons.com/mobile-commons-api/

Requirements
-
* PHP 5 (Tested against 5.3)
* cURL extension
* SimpleXML extension

Installation
-

Via Composer:

Available on Packagist as the dosomething/mobilecommons-php package


Usage
-

````
$config = array(
  'username' => USERNAME, // Mobile commons username
  'password' => PW // Mobilecommons password
);

$MobileCommons = new MobileCommons($config);

$campaigns = $MobileCommons->campaigns();

print_r($campaigns); // Print list of campaigns
````

License
-
This library is released under the [MIT License](http://opensource.org/licenses/MIT)
