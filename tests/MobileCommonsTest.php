<?php

class MobileCommonsTest extends PHPUnit_Framework_TestCase
{

    public static $authentication_config = array(
        'username' => 'username',
        'password' => 'password'
    );

    public function setUp()
    {
        $stub = $this->getMock(
            'Request',
            array('call'),
            array(self::$authentication_config)
        );

        $response = simplexml_load_string( '<?xml version="1.0" encoding="UTF-8"?>
            <response success="true"></response>');
       
        $stub->expects($this->any())
            ->method('call')
            ->will($this->returnValue($response));
        $this->MobileCommons = new MobileCommons($stub);
    }

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
        $MobileCommons = new MobileCommons(null, $config);
    }

    /**
     * @expectedException Exception
     */
    public function testMissingPasswordThrowsException()
    {
        $config = self::$authentication_config;
        unset($config['password']);
        $MobileCommons = new MobileCommons(null, $config);
    }

    public function testValidAuthenticationString()
    {
        $MobileCommons = new MobileCommons(null, self::$authentication_config);

        $this->assertRegExp(
            '/[A-Za-z0-9]+\:[A-Za-z0-9]+/',
            $MobileCommons->Request->getAuthenticationString()
        );
    }

    private function _testCallResponse($method, $params = array())
    {
        return $this->assertTrue( is_object( $this->MobileCommons->$method($params) ) );
    }

    public function testListCalls()
    {
        $this->_testCallResponse('calls');
    }

    public function testListCampaigns()
    {
        $this->_testCallResponse('campaigns');
    }

    public function testSendCampaignBroadcast()
    {
        $this->_testCallResponse('campaigns_broadcast');
    }

    public function testListCampaignSubscribers()
    {
        $this->_testCallResponse('campaigns_subscribers', array());
    }

    public function testListClicks()
    {
        $this->_testCallResponse('clicks', array());
    }

    public function testListDonations()
    {
        $this->_testCallResponse('donations_get');
    }

    public function testCreateGroup()
    {
        $this->_testCallResponse('groups_create', array());
    }

    public function testListGroups()
    {
        $this->_testCallResponse('groups');
    }

    public function testListGroupMembers()
    {
        $this->_testCallResponse('groups_members', array());
    }

    public function testCreateGroupMember()
    {
        $this->_testCallResponse('groups_members_create', array());
    }

    public function testRemoveGroupMember()
    {
        $this->_testCallResponse('groups_members_delete', array());
    }

    public function testCountMconnect()
    {
        $this->_testCallResponse('mconnect_count');
    }

    public function testGetProfile()
    {
        $this->_testCallResponse('profiles_get', array());
    }

    public function testListProfiles()
    {
        $this->_testCallResponse('profiles');
    }

    public function testUpdateProfile()
    {
        $this->_testCallResponse('profiles_update', array());
    }

    public function testListMessages()
    {
        $this->_testCallResponse('messages');
    }

    public function testSendMessage()
    {
        $this->_testCallResponse('messages_send');
    }

    public function testListSentMessages()
    {
        $this->_testCallResponse('messages_sent');
    }

}
