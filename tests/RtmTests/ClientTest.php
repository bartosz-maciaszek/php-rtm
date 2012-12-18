<?php

namespace RtmTests;

use Rtm\Client;

use PHPUnit_Framework_TestCase as TestCase;

class ClientTest extends TestCase
{
    public function testConstructor()
    {
        $client = new Client('77bab94ee2471173898a8cec8c901692', '3d8bfb94932039e3');
//         var_dump($client->getAuthUrl());
//         exit;
        
        print_r($client->get('rtm.lists.getList'));
    }
}