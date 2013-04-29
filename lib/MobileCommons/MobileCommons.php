<?php

/*
 * MobileCommons API class
 * API Documentation: http://www.mobilecommons.com/mobile-commons-api/
 */

class MobileCommons
{
    /**
     * Constructor
     *
     * @param array $config Configuration variables
     * @return void
     */
    public function __construct($config, Request $requestInstance = null)
    {
        $this->Request = is_null( $requestInstance ) ? new Request($config) : $requestInstance;
    }

    /**
     * Calls: List
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListCalls
     *
     * @param array $args
     * @return array
     */
    public function calls($args = array()) {
        return $this->Request->call('calls', $args);
    }

    /**
     * Campaigns: List
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListCampaigns
     *
     * @param array $args
     * @return array
     */
    public function campaigns($args = array()) {
        return $this->Request->call('campaigns', $args);
    }

    /**
     * Campaigns: Broadcast
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#SendBroadcasttoCampaignSubscribers
     *
     * @param array $args
     * @return array
     */
    public function campaigns_broadcast($args = array()) {
        return $this->Request->call('schedule_broadcast', $args, 'POST');
    }

    /**
     * Campaigns: Subscribers
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListCampaignSubscribers
     *
     * @param array $args
     * @return array
     */
    public function campaigns_subscribers($args) {
        return $this->Request->call('campaign_subscribers', $args);
    }

    /**
     * Clicks: List
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#Clicks
     *
     * @param array $args
     * @return array
     */
    public function clicks($args) {
        return $this->Request->call('clicks', $args);
    }

    /**
     * Donations: Get
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#DonationSummary
     *
     * @param array $args
     * @return array
     */
    public function donations_get($args = array()) {
        return $this->Request->call('donation_summary', $args);
    }

    /**
     * Groups: Create
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#CreateGroup
     *
     * @param array $args
     * @return array
     */
    public function groups_create($args) {
        return $this->Request->call('create_group', $args);
    }

    /**
     * Groups: List
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListGroups
     *
     * @return array
     */
    public function groups() {
        return $this->Request->call('groups');
    }

    /**
     * Groups: Members
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListGroupMembers
     *
     * @param array $args
     * @return array
     */
    public function groups_members($args) {
        return $this->Request->call('group_members', $args);
    }

    /**
     * Groups: Create Member
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#AddGroupMember
     *
     * @param array $args
     * @return array
     */
    public function groups_members_create($args) {
        return $this->Request->call('add_group_member', $args);
    }

    /**
     * Groups: Delete Member
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#RemoveGroupMember
     *
     * @param array $args
     * @return array
     */
    public function groups_members_delete($args) {
        return $this->Request->call('remove_group_member', $args);
    }

    /**
     * mConnect: Count
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#CallCount
     *
     * @param array $args
     * @return array
     */
    public function mconnect_count($args = array()) {
        return $this->Request->call('call_count', $args);
    }

    /**
     * Profiles: Get
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ProfileSummary
     *
     * @param array $args
     * @return array
     */
    public function profiles_get($args = array()) {
        return $this->Request->call('profile', $args);
    }

    /**
     * Profiles: List
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListAllProfiles
     *
     * @param array $args
     * @return array
     */
    public function profiles($args = array()) {
        return $this->Request->call('profiles', $args);
    }

    /**
     * Profiles: Update
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ProfileUpdate
     *
     * @param array $args
     * @return array
     */
    public function profiles_update($args = array()) {
        return $this->Request->call('profile_update', $args, 'POST');
    }

    /**
     * Messages: Incoming Messages List
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListIncomingMessages
     *
     * @param array $args
     * @return array
     */
    public function messages($args = array()) {
        return $this->Request->call('messages', $args);
    }

    /**
     * Messages: Send
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#SendSMSMessage
     *
     * @param array $args
     * @return array
     */
    public function messages_send($args = array()) {
        return $this->Request->call('send_message', $args, 'POST');
    }

    /**
     * Messages: Outgoing Messages List
     * @see http://www.mobilecommons.com/mobile-commons-api/rest/#ListOutgoingMessages
     *
     * @param array $args
     * @return array
     */
    public function messages_sent($args = array()) {
        return $this->Request->call('sent_messages', $args);
    }

}
