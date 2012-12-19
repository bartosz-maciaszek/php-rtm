<?php

require_once 'bootstrap.php';

use Rtm\Rtm;

$rtm = new Rtm(API_KEY, SECRET);
$rtm->setAuthToken(isset($_SESSION['RTM_AUTH_TOKEN']) ? $_SESSION['RTM_AUTH_TOKEN'] : null);

try
{
    // Check authentication token
    $rtm->getService(Rtm::SERVICE_AUTH)->checkToken();
}
catch(Exception $e)
{
    // No perrmissions, let's get it
    header('Location: rtm.php');
}

$tasks = $rtm->getService(Rtm::SERVICE_LISTS);

echo '<pre>';
print_r($tasks->getList());
exit;