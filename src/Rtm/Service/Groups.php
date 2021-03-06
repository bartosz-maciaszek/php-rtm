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

class Groups extends AbstractService
{
    /**
     * Creates a new group.
     * @param string  $group
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.groups.add.rtm
     */
    public function add($group, $timeline = null)
    {
        $params = array(
            'group'    => $group,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_GROUPS_ADD, $params);
    }

    /**
     * Adds a contact to a group.
     * @param integer $groupId
     * @param integer $contactId
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.groups.addContact.rtm
     */
    public function addContact($groupId, $contactId, $timeline = null)
    {
        $params = array(
            'group_id'   => $groupId,
            'contact_id' => $contactId,
            'timeline'   => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_GROUPS_ADD_CONTACT, $params);
    }

    /**
     * Deletes a group.
     * @param  integer $groupId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.groups.delete.rtm
     */
    public function delete($groupId, $timeline = null)
    {
        $params = array(
            'group_id' => $groupId,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_GROUPS_DELETE, $params);
    }

    /**
     * Retrieves a list of groups.
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.groups.getList.rtm
     */
    public function getList()
    {
        return $this->rtm->call(Rtm::METHOD_GROUPS_GET_LIST)->getGroups();
    }

    /**
     * Removes a contact from a group.
     * @param  integer $groupId
     * @param  integer $contactId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.groups.removeContact.rtm
     */
    public function removeContact($groupId, $contactId, $timeline = null)
    {
        $params = array(
            'group_id'   => $groupId,
            'contact_id' => $contactId,
            'timeline'   => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_GROUPS_REMOVE_CONTACT, $params);
    }
}
