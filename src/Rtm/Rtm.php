<?php

namespace Rtm;

class Rtm
{
    const URL_SERVICE = 'http://api.rememberthemilk.com/services/rest/';
    const URL_AUTH    = 'http://www.rememberthemilk.com/services/auth/';

    const SERVICE_AUTH      = 'Rtm\Service\Auth';
    const SERVICE_CONTACTS  = 'Rtm\Service\Contacts';
    const SERVICE_LISTS     = 'Rtm\Service\Lists';
    const SERVICE_TIMELINES = 'Rtm\Service\Timelines';

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

    const METHOD_TIMELINES_CREATE  = 'rtm.timelines.create';

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