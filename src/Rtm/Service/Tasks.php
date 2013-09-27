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

class Tasks extends AbstractService
{
    /**
     * Adds a task, name, to the list specified by listId.
     * If list_id is omitted, the task will be added to the Inbox.
     * If parse is 1, Smart Add will be used to process the task.
     * @param string  $name
     * @param integer $listId
     * @param integer $parse
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.add.rtm
     */
    public function add($name, $listId = null, $parse = null, $timeline = null)
    {
        $params = array(
            'name'     => $name,
            'list_id'  => $listId,
            'parse'    => $parse,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_ADD, $params);
    }

    /**
     * Add tags to a task. $tags should be a comma delimited list of tags.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $tags
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.addTags.rtm
     */
    public function addTags($taskId, $listId, $taskSeriesId, $tags, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => $tags,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_ADD_TAGS, $params);
    }

    /**
     * Marks a task complete.
     * @param  integer $taskId
     * @param  integer $listId
     * @param  integer $taskSeriesId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.complete.rtm
     */
    public function complete($taskId, $listId, $taskSeriesId, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_COMPLETE, $params);
    }

    /**
     * Marks a task as deleted.
     * @param  integer $taskId
     * @param  integer $listId
     * @param  integer $taskSeriesId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.delete.rtm
     */
    public function delete($taskId, $listId, $taskSeriesId, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_DELETE, $params);
    }

    /**
     * Retrieves a list of tasks.
     * If $listId is not specified, all tasks are retrieved, unless $filter is specified.
     * If $lastSync is provided, only tasks modified since $lastSync will be returned, and each <list> element will have an attribute, current, equal to $lastSync.
     * @param  string  $filter
     * @param  integer $listId
     * @param  integer $lastSync
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.getList.rtm
     */
    public function getList($filter = null, $listId = null, $lastSync = null)
    {
        $params = array(
            'filter'    => $filter,
            'list_id'   => $listId,
            'last_sync' => $lastSync
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_GET_LIST, $params)->getTasks()->getList();
    }

    /**
     * Moves the priority of a task up or down depending on $direction.
     * @param  string  $direction
     * @param  integer $taskId
     * @param  integer $listId
     * @param  integer $taskSeriesId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.movePriority.rtm
     */
    public function movePriority($direction, $taskId, $listId, $taskSeriesId, $timeline = null)
    {
        $params = array(
            'direction'     => $direction,
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_MOVE_PRIORITY, $params);
    }

    /**
     * Move a task between lists.
     * @param  integer $taskId
     * @param  integer $fromListId
     * @param  integer $toListId
     * @param  integer $taskSeriesId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.moveTo.rtm
     */
    public function moveTo($taskId, $fromListId, $toListId, $taskSeriesId, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'from_list_id'  => $fromListId,
            'to_list_id'    => $toListId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_MOVE_TO, $params);
    }

    /**
     * Postpones a task. If the task has no due date or is overdue, its due date is set to today.
     * Otherwise, the task due date is advanced a day.
     * @param  integer $taskId
     * @param  integer $listId
     * @param  integer $taskSeriesId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.postpone.rtm
     */
    public function postpone($taskId, $listId, $taskSeriesId, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_POSTPONE, $params);
    }

    /**
     * ARemoves tags from a task. $tags should be a comma delimited list of tags.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $tags
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.removeTags.rtm
     */
    public function removeTags($taskId, $listId, $taskSeriesId, $tags, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => $tags,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_REMOVE_TAGS, $params);
    }

    /**
     * Sets the due date of a task. If $due is not provided, any existing due date will be unset.
     * If $hasDueTime is provided, the due date will be marked as one with a time.
     * If $parse has a value of 1, $due is parsed as per rtm.time.parse.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $due
     * @param integer $hasDueTime
     * @param integer $parse
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setDueDate.rtm
     */
    public function setDueDate($taskId, $listId, $taskSeriesId, $due = null, $hasDueTime = null, $parse = null, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'due'           => $due,
            'has_due_time'  => $hasDueTime,
            'parse'         => $parse,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_DUE_DATE, $params);
    }

    /**
     * Sets a time estimate for a task. $estimate should be provided in a values of days, hours or minutes.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $estimate
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setEstimate.rtm
     */
    public function setEstimate($taskId, $listId, $taskSeriesId, $estimate = null, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'estimate'      => $estimate,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_ESTIMATE, $params);
    }

    /**
     * Sets a location for a task.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param integer $locationId
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setLocation.rtm
     */
    public function setLocation($taskId, $listId, $taskSeriesId, $locationId = null, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'location_id'   => $locationId,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_LOCATION, $params);
    }

    /**
     * Renames a task.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $name
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setName.rtm
     */
    public function setName($taskId, $listId, $taskSeriesId, $name, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'name'          => $name,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_NAME, $params);
    }

    /**
     * Sets the priority of a task. Valid values are 1, 2 and 3.
     * If $priority is not specified or is an invalid value, the task is marked as having no priority.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param integer $priority
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setPriority.rtm
     */
    public function setPriority($taskId, $listId, $taskSeriesId, $priority = null, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'priority'      => $priority,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_PRIORITY, $params);
    }

    /**
     * Sets a recurrence pattern for a task. Valid values of $repeat are detailed
     * at https://www.rememberthemilk.com/help/answers/basics/repeatformat.rtm
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $repeat
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setRecurrence.rtm
     */
    public function setRecurrence($taskId, $listId, $taskSeriesId, $repeat = null, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'repeat'        => $repeat,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_RECURRENCE, $params);
    }

    /**
     * Set tags for a task. $tags should be a comma delimited list of tags.
     * Any previous task tags will be overwritten.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $tags
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setTags.rtm
     */
    public function setTags($taskId, $listId, $taskSeriesId, $tags = null, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => $tags,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_TAGS, $params);
    }

    /**
     * Sets an URL for a task.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param string  $url
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.setURL.rtm
     */
    public function setUrl($taskId, $listId, $taskSeriesId, $url = null, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'url'           => $url,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_URL, $params);
    }

    /**
     * Marks a task incomplete.
     * @param integer $taskId
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.uncomplete.rtm
     */
    public function uncomplete($taskId, $listId, $taskSeriesId, $timeline = null)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_UNCOMPLETE, $params);
    }
}
