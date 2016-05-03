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
    public function __construct($config = array(), Request $requestInstance = null)
    {
        $this->Request = is_null( $requestInstance ) ? new Request($config) : $requestInstance;
    }

    /**
     * Calls: List
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListCalls
     *
     * @param array $args
     * @return array
     */
    public function calls($args = array()) {
        return $this->Request->call('calls', $args);
    }

    /**
     * Campaigns: List
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListCampaigns
     *
     * @param array $args
     * @return array
     */
    public function campaigns($args = array()) {
        return $this->Request->call('campaigns', $args);
    }

    /**
     * Campaigns: Broadcast
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#SendBroadcasttoCampaignSubscribers
     *
     * @param array $args
     * @return array
     */
    public function campaigns_broadcast($args = array()) {
        return $this->Request->call('schedule_broadcast', $args, 'POST');
    }

    /**
     * Campaigns: Subscribers
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListCampaignSubscribers
     *
     * @param array $args
     * @return array
     */
    public function campaigns_subscribers($args) {
        return $this->Request->call('campaign_subscribers', $args);
    }

    /**
     * Clicks: List
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#Clicks
     *
     * @param array $args
     * @return array
     */
    public function clicks($args) {
        return $this->Request->call('clicks', $args);
    }

    /**
     * Donations: Get
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#DonationSummary
     *
     * @param array $args
     * @return array
     */
    public function donations_get($args = array()) {
        return $this->Request->call('donation_summary', $args);
    }

    /**
     * Groups: Create
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#CreateGroup
     *
     * @param array $args
     * @return array
     */
    public function groups_create($args) {
        return $this->Request->call('create_group', $args);
    }

    /**
     * Groups: List
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListGroups
     *
     * @return array
     */
    public function groups() {
        return $this->Request->call('groups');
    }

    /**
     * Groups: Members
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListGroupMembers
     *
     * @param array $args
     * @return array
     */
    public function groups_members($args) {
        return $this->Request->call('group_members', $args);
    }

    /**
     * Groups: Create Member
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#AddGroupMember
     *
     * @param array $args
     * @return array
     */
    public function groups_members_create($args) {
        return $this->Request->call('add_group_member', $args);
    }

    /**
     * Groups: Delete Member
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#RemoveGroupMember
     *
     * @param array $args
     * @return array
     */
    public function groups_members_delete($args) {
        return $this->Request->call('remove_group_member', $args);
    }

    /**
     * mConnect: Count
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#CallCount
     *
     * @param array $args
     * @return array
     */
    public function mconnect_count($args = array()) {
        return $this->Request->call('call_count', $args);
    }

    /**
     * Profile Opt-In
     * @see https://secure.mcommons.com/help/forms#form
     *
     * @param array $args
     *   An associative array of values to send to the API query string, 
     *   keyed by the parameter name each value is associated with.
     *
     *   If looking to make use of the `friends[]` parameter,
     *   @see opt_in_with_friends().
     *
     * @return string
     */
    public function opt_in($args = array()) {
        return $this->Request->webform('join', $args);
    }

    /**
     * Profile Opt-In with Friends
     * @see https://secure.mcommons.com/help/forms#parameters
     *
     * @param array $args
     *   An associative array with keys:
     *
     *   - args: An associative array of values to send to the API query string
     *     keyed by the parameter name each value is associated with. 
     *     Should exclude any values to send to the `friends[]` parameter.
     *
     *   - friends: An array of friends mobile numbers, each of which to send 
     *     as a `friends[]` parameter.
     *
     * @return string
     */
    public function opt_in_with_friends($args) {
        return $this->Request->webform('join', $args['args'], $args['friends']);
    }

    /**
     * Profile Opt-Out
     * @see https://secure.mcommons.com/help/forms#optout
     *
     * @param array $args
     * @return string
     */
    public function opt_out($args = array()) {
        $args['company_key'] = $this->Request->getCompanyKey();
        return $this->Request->webform('opt_out', $args);
    }


    /**
     * Profiles: Get
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ProfileSummary
     *
     * @param array $args
     * @return array
     */
    public function profiles_get($args = array()) {
        return $this->Request->call('profile', $args);
    }

    /**
     * Profiles: List
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListAllProfiles
     *
     * @param array $args
     * @return array
     */
    public function profiles($args = array()) {
        return $this->Request->call('profiles', $args);
    }

    /**
     * Profiles: Update
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ProfileUpdate
     *
     * @param array $args
     * @return array
     */
    public function profiles_update($args = array()) {
        return $this->Request->call('profile_update', $args, 'POST');
    }

    /**
     * Messages: Incoming Messages List
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListIncomingMessages
     *
     * @param array $args
     * @return array
     */
    public function messages($args = array()) {
        return $this->Request->call('messages', $args);
    }

    /**
     * Messages: Send
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#SendSMSMessage
     *
     * @param array $args
     * @return array
     */
    public function messages_send($args = array()) {
        return $this->Request->call('send_message', $args, 'POST');
    }

    /**
     * Messages: Outgoing Messages List
     * @see https://mobilecommons.zendesk.com/hc/en-us/articles/202052534-REST-API/#ListOutgoingMessages
     *
     * @param array $args
     * @return array
     */
    public function messages_sent($args = array()) {
        return $this->Request->call('sent_messages', $args);
    }

}
