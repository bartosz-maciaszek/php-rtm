<?php

namespace Rtm;

class Rtm implements RtmInterface
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
    const SERVICE_GROUPS        = 'Rtm\Service\Groups';
    const SERVICE_LISTS         = 'Rtm\Service\Lists';
    const SERVICE_LOCATIONS     = 'Rtm\Service\Locations';
    const SERVICE_NOTES         = 'Rtm\Service\Notes';
    const SERVICE_REFLECTION    = 'Rtm\Service\Reflection';
    const SERVICE_SETTINGS      = 'Rtm\Service\Settings';
    const SERVICE_TASKS         = 'Rtm\Service\Tasks';
    const SERVICE_TEST          = 'Rtm\Service\Test';
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

    const METHOD_GROUPS_ADD            = 'rtm.groups.add';
    const METHOD_GROUPS_ADD_CONTACT    = 'rtm.groups.addContact';
    const METHOD_GROUPS_DELETE         = 'rtm.groups.delete';
    const METHOD_GROUPS_GET_LIST       = 'rtm.groups.getList';
    const METHOD_GROUPS_REMOVE_CONTACT = 'rtm.groups.removeContact';

    const METHOD_LISTS_ADD         = 'rtm.lists.add';
    const METHOD_LISTS_ARCHIVE     = 'rtm.lists.archive';
    const METHOD_LISTS_DELETE      = 'rtm.lists.delete';
    const METHOD_LISTS_GET_LIST    = 'rtm.lists.getList';
    const METHOD_LISTS_SET_DEFAULT = 'rtm.lists.setDefaultList';
    const METHOD_LISTS_SET_NAME    = 'rtm.lists.setName';
    const METHOD_LISTS_UNARCHIVE   = 'rtm.lists.unarchive';

    const METHOD_LOCATIONS_GET_LIST = 'rtm.locations.getList';

    const METHOD_NOTES_ADD    = 'rtm.tasks.notes.add';
    const METHOD_NOTES_DELETE = 'rtm.tasks.notes.delete';
    const METHOD_NOTES_EDIT   = 'rtm.tasks.notes.edit';

    const METHOD_REFLECTION_GET_METHOD_INFO = 'rtm.reflection.getMethodInfo';
    const METHOD_REFLECTION_GET_METHODS     = 'rtm.reflection.getMethods';

    const METHOD_SETTINGS_GET_LIST = 'rtm.settings.getList';

    const METHOD_TASKS_ADD            = 'rtm.tasks.add';
    const METHOD_TASKS_ADD_TAGS       = 'rtm.tasks.addTags';
    const METHOD_TASKS_COMPLETE       = 'rtm.tasks.complete';
    const METHOD_TASKS_DELETE         = 'rtm.tasks.delete';
    const METHOD_TASKS_GET_LIST       = 'rtm.tasks.getList';
    const METHOD_TASKS_MOVE_PRIORITY  = 'rtm.tasks.movePriority';
    const METHOD_TASKS_MOVE_TO        = 'rtm.tasks.moveTo';
    const METHOD_TASKS_POSTPONE       = 'rtm.tasks.postpone';
    const METHOD_TASKS_REMOVE_TAGS    = 'rtm.tasks.removeTags';
    const METHOD_TASKS_SET_DUE_DATE   = 'rtm.tasks.setDueDate';
    const METHOD_TASKS_SET_ESTIMATE   = 'rtm.tasks.setEstimate';
    const METHOD_TASKS_SET_LOCATION   = 'rtm.tasks.setLocation';
    const METHOD_TASKS_SET_NAME       = 'rtm.tasks.setName';
    const METHOD_TASKS_SET_PRIORITY   = 'rtm.tasks.setPriority';
    const METHOD_TASKS_SET_RECURRENCE = 'rtm.tasks.setRecurrence';
    const METHOD_TASKS_SET_TAGS       = 'rtm.tasks.setTags';
    const METHOD_TASKS_SET_URL        = 'rtm.tasks.setURL';
    const METHOD_TASKS_UNCOMPLETE     = 'rtm.tasks.uncomplete';

    const METHOD_TEST_ECHO = 'rtm.test.echo';
    const METHOD_TEST_LOGIN = 'rtm.test.login';

    const METHOD_TIME_CONVERT = 'rtm.time.convert';
    const METHOD_TIME_PARSE   = 'rtm.time.parse';

    const METHOD_TIMELINES_CREATE  = 'rtm.timelines.create';

    const METHOD_TIMEZONES_GET_LIST  = 'rtm.timezones.getList';

    const METHOD_TRANSACTIONS_UNDO  = 'rtm.transactions.undo';

    const AUTH_TYPE_READ   = 'read';
    const AUTH_TYPE_WRITE  = 'write';
    const AUTH_TYPE_DELETE = 'delete';

    private $apiKey = null;

    private $secret = null;

    private $responseFormat = null;

    private $authToken = null;

    private $frob = null;

    private $client = null;

    private $timeline = null;

    private $services = array();

    public function __construct(array $config = array())
    {
        foreach ($config as $key => $value) {
            $method = 'set' . $key;
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getService($name)
    {
        if(!isset($this->services[$name]))
        {
            $this->services[$name] = new $name($this);
        }

        return $this->services[$name];
    }

    public function setClient(ClientInterface $client)
    {
        $client->setRtm($this);
        $this->client = $client;
    }

    public function getClient()
    {
        if (null === $this->client) {
            $this->setClient(new Client);
        }

        return $this->client;
    }

    public function setFrob($frob)
    {
        $this->frob = $frob;
        return $this;
    }

    public function getFrob()
    {
        if (false === isset($this->frob)) {
            throw new Exception('Frob not set');
        }

        return $this->frob;
    }

    public function setTimeline($timeline)
    {
        $this->timeline = $timeline;
        return $this;
    }

    public function getTimeline()
    {
        if (false === isset($this->timeline)) {
            throw new Exception('Timeline not set');
        }

        return $this->timeline;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getApiKey()
    {
        if (false === isset($this->apiKey)) {
            throw new Exception('Api key not set');
        }

        return $this->apiKey;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    public function getSecret()
    {
        if (false === isset($this->secret)) {
            throw new Exception('Secret not set');
        }

        return $this->secret;
    }

    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

    public function getAuthToken()
    {
        if (false === isset($this->authToken)) {
            throw new Exception('Auth token not set');
        }

        return $this->authToken;
    }

    public function setResponseFormat($responseFormat)
    {
        if (!preg_match('/^(json|rest)$/', $responseFormat)) {
            throw new \InvalidArgumentException('Response type should be \'rest\' or \'json\'.');
        }

        $this->responseFormat = $responseFormat;
        return $this;
    }

    public function getResponseFormat()
    {
        return $this->responseFormat;
    }

    public function call($method, array $params = array())
    {
        return $this->client->call($method, $params);
    }

    public function getAuthUrl($perms = self::AUTH_TYPE_READ)
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