<?php

require_once 'bootstrap.php';

use Rtm\Rtm;

$rtm = new Rtm(API_KEY, SECRET);
$rtm->setAuthToken(isset($_SESSION['RTM_AUTH_TOKEN']) ? $_SESSION['RTM_AUTH_TOKEN'] : null);

try
{
    // Check authentication token
    $rtm->getService(Rtm::SERVICE_AUTH)->checkToken();

    // Successfully authenticated, redirect to app
    header('Location: index.php');
}
catch(Exception $e)
{
    // Authentication request is taking place?
    if(isset($_GET['frob']))
    {
        try
        {
            $response = $rtm->getService(Rtm::SERVICE_AUTH)->getToken($_GET['frob']);
            $_SESSION['RTM_AUTH_TOKEN'] = $response->getToken();
            $rtm->setAuthToken($response->getToken());

            // Check authentication token
            $rtm->getService(Rtm::SERVICE_AUTH)->checkToken();

            // Authentication successful
            header('Location: rtm.php');
        }
        catch(Exception $e)
        {
            echo 'Authentication somewhat failed...';
        }
    }
    else
    {
        // No permissions, acquire it
        header('Location: ' . $rtm->getAuthUrl('delete'));
    }
}
