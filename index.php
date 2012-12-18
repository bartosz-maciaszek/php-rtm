<?php

require_once 'bootstrap.php';

$rtm = new \Rtm\Rtm(API_KEY, SECRET);
$rtm->setAuthToken(isset($_SESSION['RTM_AUTH_TOKEN']) ? $_SESSION['RTM_AUTH_TOKEN'] : null);

try
{
    // Check authentication token
    $rtm->auth->checkToken();

    $tasks = $rtm->get('rtm.lists.getList');
    foreach($tasks->getLists()->getList() as $list)
    {
        echo '<a href="' . $list->getId() . '">' . $list->getName() . '</a><br />';
    }
}
catch(Exception $e)
{
    // No perrmissions, let's get it
    header('Location: rtm.php');
}
