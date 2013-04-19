<?php

namespace Rtm;

interface RtmInterface
{
    public function __construct(array $config = array());

    public function getService($name);

    public function setClient(ClientInterface $client);

    public function getClient();

    public function setFrob($frob);

    public function getFrob();

    public function setTimeline($timeline);

    public function getTimeline();

    public function setApiKey($apiKey);

    public function getApiKey();

    public function setSecret($secret);

    public function getSecret();

    public function setAuthToken($authToken);

    public function getAuthToken();

    public function call($method, array $params = array());

    public function getAuthUrl($perms = 'read');
}