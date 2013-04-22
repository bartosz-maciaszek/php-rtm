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
 * @package    Rtm.Service
 * @author     Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 * @copyright  2013 Bartosz Maciaszek.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */

namespace Rtm\Service;

use Rtm\Rtm;

class Auth extends AbstractService
{
    /**
     * Returns the credentials attached to an authentication token.
     * @param  string $authToken
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.auth.checkToken.rtm
     */
    public function checkToken($authToken = null)
    {
        if (null === $authToken) {
            $authToken = $this->rtm->getAuthToken();
        }

        return $this->rtm->call(Rtm::METHOD_AUTH_CHECK_TOKEN, array('auth_token' => $authToken))->getAuth();
    }

    /**
     * Returns a frob to be used during authentication.
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.auth.getFrob.rtm
     */
    public function getFrob()
    {
        $response = $this->rtm->call(Rtm::METHOD_AUTH_GET_FROB);

        $this->rtm->setFrob($response->getFrob());
        return $this->rtm->getFrob();
    }

    /**
     * Returns the auth token for the given frob, if one has been attached.
     * @param  string $frob
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.auth.getToken.rtm
     */
    public function getToken($frob = null)
    {
        if (null === $frob) {
            $frob = $this->rtm->getFrob();
        }

        return $this->rtm->call(Rtm::METHOD_AUTH_GET_TOKEN, array('frob' => $frob))->getAuth();
    }
}
