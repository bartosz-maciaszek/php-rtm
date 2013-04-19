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

class Lists extends AbstractService
{
    public function add($name, $filter = null, $timeline = 0)
    {
        $params = array(
            'name'     => $name,
            'filter'   => $filter,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_ADD, $params);
    }

    public function archive($listId, $timeline = 0)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_ARCHIVE, $params);
    }

    public function delete($listId, $timeline = 0)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_DELETE, $params);
    }

    public function getList()
    {
        return $this->rtm->call(RTM::METHOD_LISTS_GET_LIST)->getLists()->getList();
    }

    public function setDefaultList($listId, $timeline = 0)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_SET_DEFAULT, $params);
    }

    public function setName($listId, $name, $timeline = 0)
    {
        $params = array(
            'list_id'  => $listId,
            'name'     => $name,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_SET_NAME, $params);
    }

    public function unarchive($listId, $timeline = 0)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_UNARCHIVE, $params);
    }
}
