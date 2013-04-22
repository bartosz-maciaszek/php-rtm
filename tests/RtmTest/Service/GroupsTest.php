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
 * @package    RtmTest
 * @author     Bartosz Maciaszek <bartosz.maciaszek@gmail.com>
 * @copyright  2013 Bartosz Maciaszek.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 */

namespace RtmTest\Service;

use Rtm\Rtm;
use Rtm\ServiceTestCase;

class GroupsTest extends ServiceTestCase
{
    public function getServiceMethodsMatrix()
    {
        return array(

            /** groups.add */
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_ADD,
                array('group' => 'Test group'),
                array('group' => 'Test group', 'timeline' => 0)),
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_ADD,
                array('group' => 'Test group', 'timeline' => 123),
                array('group' => 'Test group', 'timeline' => 123)),

            /** groups.addContact */
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_ADD_CONTACT,
                array('group_id' => 123, 'contact_id' => 123),
                array('group_id' => 123, 'contact_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_ADD_CONTACT,
                array('group_id' => 123, 'contact_id' => 123, 'timeline' => 123),
                array('group_id' => 123, 'contact_id' => 123, 'timeline' => 123)),

            /** groups.delete */
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_DELETE,
                array('group_id' => 123),
                array('group_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_DELETE,
                array('group_id' => 123, 'timeline' => 123),
                array('group_id' => 123, 'timeline' => 123)),

            /** groups.getList */
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_GET_LIST,
                array(),
                array()),

            /** groups.removeContact */
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_REMOVE_CONTACT,
                array('group_id' => 123, 'contact_id' => 123),
                array('group_id' => 123, 'contact_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_GROUPS,
                Rtm::METHOD_GROUPS_REMOVE_CONTACT,
                array('group_id' => 123, 'contact_id' => 123, 'timeline' => 123),
                array('group_id' => 123, 'contact_id' => 123, 'timeline' => 123)),
        );
    }
}