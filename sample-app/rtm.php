<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2013 Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author     Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 * @copyright  2013 Bartosz Maciaszek.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */

require_once 'bootstrap.php';

use Rtm\Rtm;

$rtm = new Rtm;
$rtm->setApiKey(API_KEY);
$rtm->setSecret(SECRET);
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
    if (isset($_GET['frob'])) {
        try
        {
            // Set the frob parameter
            $rtm->setFrob($_GET['frob']);

            // Call the getToken method, to acquire the token
            $response = $rtm->getService(Rtm::SERVICE_AUTH)->getToken();

            // Save token in Rtm object
            $rtm->setAuthToken($response->getToken());

            // Save token in session
            $_SESSION['RTM_AUTH_TOKEN'] = $rtm->getAuthToken();

            // Check authentication token
            $rtm->getService(Rtm::SERVICE_AUTH)->checkToken();

            // Authentication successful, redirect back to auth script to check again the token
            header('Location: rtm.php');
        }
        catch(Exception $e)
        {
            echo 'Authentication failed...';
        }
    } else {
        // No permissions, acquire it
        header('Location: ' . $rtm->getAuthUrl(Rtm::AUTH_TYPE_READ));
    }
}
