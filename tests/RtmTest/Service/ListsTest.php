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

class ListsTest extends ServiceTestCase
{
    public function getServiceMethodsMatrix()
    {
        return array(

            /** lists.add */
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_ADD,
                array('name' => 'Test'),
                array('name' => 'Test', 'filter' => null, 'timeline' => 0)),
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_ADD,
                array('name' => 'Test', 'filter' => 'test'),
                array('name' => 'Test', 'filter' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_ADD,
                array('name' => 'Test', 'filter' => 'test', 'timeline' => 123),
                array('name' => 'Test', 'filter' => 'test', 'timeline' => 123)),

            /** lists.archive */
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_ARCHIVE,
                array('list_id' => 123),
                array('list_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_ARCHIVE,
                array('list_id' => 123, 'timeline' => 123),
                array('list_id' => 123, 'timeline' => 123)),

            /** lists.delete */
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_DELETE,
                array('list_id' => 123),
                array('list_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_DELETE,
                array('list_id' => 123, 'timeline' => 123),
                array('list_id' => 123, 'timeline' => 123)),

            /** lists.getList */
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_GET_LIST,
                array(),
                array()),
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_SET_DEFAULT,
                array('list_id' => 123),
                array('list_id' => 123, 'timeline' => 0)),

            /** lists.setDefault */
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_SET_DEFAULT,
                array('list_id' => 123, 'timeline' => 123),
                array('list_id' => 123, 'timeline' => 123)),

            /** lists.setName */
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_SET_NAME,
                array('list_id' => 123, 'name' => 'Test'),
                array('list_id' => 123, 'name' => 'Test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_SET_NAME,
                array('list_id' => 123, 'name' => 'Test', 'timeline' => 123),
                array('list_id' => 123, 'name' => 'Test', 'timeline' => 123)),

            /** lists.unarchive */
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_UNARCHIVE,
                array('list_id' => 123),
                array('list_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_LISTS,
                Rtm::METHOD_LISTS_UNARCHIVE,
                array('list_id' => 123, 'timeline' => 123),
                array('list_id' => 123, 'timeline' => 123)),
        );
    }
}
