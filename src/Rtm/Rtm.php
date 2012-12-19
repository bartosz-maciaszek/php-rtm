<?php

namespace Rtm;

class Rtm
{
    /**
     * URLs
     */
    const URL_SERVICE = 'http://api.rememberthemilk.com/services/rest/';
    const URL_AUTH    = 'http://www.rememberthemilk.com/services/auth/';

    /**
     * Available services
     */
    const SERVICE_AUTH          = 'Rtm\Service\Auth';
    const SERVICE_CONTACTS      = 'Rtm\Service\Contacts';
    const SERVICE_LISTS         = 'Rtm\Service\Lists';
    const SERVICE_LOCATIONS     = 'Rtm\Service\Locations';
    const SERVICE_REFLECTION    = 'Rtm\Service\Reflection';
    const SERVICE_SETTINGS      = 'Rtm\Service\Settings';
    const SERVICE_TIME          = 'Rtm\Service\Time';
    const SERVICE_TIMELINES     = 'Rtm\Service\Timelines';
    const SERVICE_TIMEZONES     = 'Rtm\Service\Timezones';
    const SERVICE_TRANSACTIONS  = 'Rtm\Service\Transactions';

    /**
     * Available methods
     */
    const METHOD_AUTH_GET_TOKEN   = 'rtm.auth.getToken';
    const METHOD_AUTH_GET_FROB    = 'rtm.auth.getFrob';
    const METHOD_AUTH_CHECK_TOKEN = 'rtm.auth.checkToken';

    const METHOD_CONTACTS_ADD      = 'rtm.contacts.add';
    const METHOD_CONTACTS_DELETE   = 'rtm.contacts.delete';
    const METHOD_CONTACTS_GET_LIST = 'rtm.contacts.getList';

    const METHOD_LISTS_ADD         = 'rtm.lists.add';
    const METHOD_LISTS_ARCHIVE     = 'rtm.lists.archive';
    const METHOD_LISTS_DELETE      = 'rtm.lists.delete';
    const METHOD_LISTS_GET_LIST    = 'rtm.lists.getList';
    const METHOD_LISTS_SET_DEFAULT = 'rtm.lists.setDefaultList';
    const METHOD_LISTS_SET_NAME    = 'rtm.lists.setName';
    const METHOD_LISTS_UNARCHIVE   = 'rtm.lists.unarchive';

    const METHOD_LOCATIONS_GET_LIST = 'rtm.locations.getList';

    const METHOD_REFLECTION_GET_METHOD_INFO = 'rtm.reflection.getMethodInfo';
    const METHOD_REFLECTION_GET_METHODS     = 'rtm.reflection.getMethods';

    const METHOD_SETTINGS_GET_LIST = 'rtm.settings.getList';

    const METHOD_TIME_CONVERT = 'rtm.time.convert';
    const METHOD_TIME_PARSE   = 'rtm.time.parse';

    const METHOD_TIMELINES_CREATE  = 'rtm.timelines.create';

    const METHOD_TIMEZONES_GET_LIST  = 'rtm.timezones.getList';

    const METHOD_TRANSACTIONS_UNDO  = 'rtm.transactions.undo';

    private $apiKey = null;

    private $secret = null;

    private $responseFormat = null;

    private $authToken = null;

    private $frob = null;

    private $client = null;

    private $timeline = 0;

    private $services = array();

    public function __construct($apiKey, $secret, $responseFormat = 'json')
    {
        $this->setApiKey($apiKey);
        $this->setSecret($secret);
        $this->setResponseFormat($responseFormat);

        $this->client = new Client($this);
    }

    public function getService($name)
    {
        if(!isset($this->services[$name]))
        {
            $this->services[$name] = new $name($this);
        }

        return $this->services[$name];
    }

    public function setFrob($frob)
    {
        $this->frob = $frob;
        return $this;
    }

    public function getFrob()
    {
        return $this->frob;
    }

    public function setTimeline($timeline)
    {
        $this->timeline = $timeline;
        return $this;
    }

    public function getTimeline()
    {
        return $this->timeline;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

    public function getAuthToken()
    {
        return $this->authToken;
    }

    public function setResponseFormat($responseFormat)
    {
        $this->responseFormat = $responseFormat;
        return $this;
    }

    public function getResponseFormat()
    {
        return $this->responseFormat;
    }

    public function get($method, array $params = array())
    {
        return $this->client->get($method, $params);
    }

    public function getAuthUrl($perms = 'read')
    {
//         if (!$this->frob)
//         {
//             $this->auth->getFrob();
//         }

        $request = new Request;
        $request->setParameter('api_key', $this->getApiKey());
//         $request->setParameter('frob', $this->frob);
        $request->setParameter('perms', $perms);
        $request->sign($this->getSecret());

        return $request->getAuthUrl();
    }
}