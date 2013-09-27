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
    /**
     * Creates a new list. If $filter is provided, a Smart List is created with the criteria specified.
     * @param string  $name
     * @param string  $filter
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.lists.add.rtm
     */
    public function add($name, $filter = null, $timeline = null)
    {
        $params = array(
            'name'     => $name,
            'filter'   => $filter,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_ADD, $params);
    }

    /**
     * Archives a list.
     * @param integer $listId
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.lists.archive.rtm
     */
    public function archive($listId, $timeline = null)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_ARCHIVE, $params);
    }

    /**
     * Deletes a list.
     * @param integer $listId
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.lists.delete.rtm
     */
    public function delete($listId, $timeline = null)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_DELETE, $params);
    }

    /**
     * Retrieves a list of lists.
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.lists.getList.rtm
     */
    public function getList()
    {
        return $this->rtm->call(RTM::METHOD_LISTS_GET_LIST)->getLists()->getList();
    }

    /**
     * Sets the default list.
     * @param integer $listId
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.lists.setDefaultList.rtm
     */
    public function setDefaultList($listId, $timeline = null)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_SET_DEFAULT, $params);
    }

    /**
     * Renames a list.
     * @param integer $listId
     * @param string  $name
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.lists.setName.rtm
     */
    public function setName($listId, $name, $timeline = null)
    {
        $params = array(
            'list_id'  => $listId,
            'name'     => $name,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_SET_NAME, $params);
    }

    /**
     * Unarchives a list.
     * @param  integer $listId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.lists.unarchive.rtm
     */
    public function unarchive($listId, $timeline = null)
    {
        $params = array(
            'list_id'  => $listId,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_LISTS_UNARCHIVE, $params);
    }
}
