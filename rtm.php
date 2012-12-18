<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/src/');

require_once 'Rtm/Rtm.php';
require_once 'Rtm/Request.php';
require_once 'Rtm/Client.php';
require_once 'Rtm/Auth.php';
require_once 'Rtm/Response.php';
require_once 'Rtm/DataContainer.php';

session_start();

$rtm = new \Rtm\Rtm('77bab94ee2471173898a8cec8c901692', '3d8bfb94932039e3');

if(isset($_GET['frob'])) {
    print_r($rtm->auth->getToken($_GET['frob']));
    exit;
}

$rtm->setAuthToken('76562261ce2f1d45af923a7fde5fc6285b923453');

if(!$rtm->getAuthToken()) {
    header("Location: ".$rtm->getAuthUrl('write'));
    exit();
}

echo '<pre>';
$tasks = $rtm->get('rtm.lists.getList');
foreach($tasks->getLists()->getList() as $list)
{
    echo '<a href="' . $list->getId() . '">' . $list->getName() . '</a><br />';
}

