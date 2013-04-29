<?php

class MobileCommonsTest extends PHPUnit_Framework_TestCase
{

    public static $authentication_config = array(
        'username' => 'username',
        'password' => 'password'
    );

    /**
     * @expectedException Exception
     */
    public function testMissingConfigThrowsException()
    {
        $MobileCommons = new MobileCommons();
    }

    /**
     * @expectedException Exception
     */
    public function testMissingUsernameThrowsException()
    {
        $config = self::$authentication_config;
        unset($config['username']);
        $MobileCommons = new MobileCommons($config);
    }

    /**
     * @expectedException Exception
     */
    public function testMissingPasswordThrowsException()
    {
        $config = self::$authentication_config;
        unset($config['password']);
        $MobileCommons = new MobileCommons($config);
    }

    public function testValidAuthenticationString()
    {
        $MobileCommons = new MobileCommons(self::$authentication_config);

        $this->assertRegExp(
            '/[A-Za-z0-9]+\:[A-Za-z0-9]+/',
            $MobileCommons->Request->getAuthenticationString()
        );
    }
}
