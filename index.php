<?php

require_once 'bootstrap.php';

use Rtm\Rtm;

$rtm = new Rtm(API_KEY, SECRET);
$rtm->setAuthToken(isset($_SESSION['RTM_AUTH_TOKEN']) ? $_SESSION['RTM_AUTH_TOKEN'] : null);

try
{
    // Check authentication token
    $rtm->getService(Rtm::SERVICE_AUTH)->checkToken();

    echo '<pre>';
    print_r($rtm->getService(Rtm::SERVICE_TEST)->login());
    exit;

    $tasks = $rtm->get('rtm.lists.getList');
    foreach($tasks->getLists()->getList() as $list)
    {
        echo '<a href="' . $list->getId() . '">' . $list->getName() . '</a><br />';
    }
}
catch(Exception $e)
{
    // No perrmissions, let's get it
    echo $e->getMessage();

    //header('Location: rtm.php');
}
