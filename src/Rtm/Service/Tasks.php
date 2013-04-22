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
    public function add($name, $listId = null, $parse = 0, $timeline = 0)
    {
        $params = array(
            'name'     => $name,
            'list_id'  => $listId,
            'parse'    => $parse,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_ADD, $params);
    }

    public function addTags($taskId, $listId, $taskSeriesId, $tags, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => $tags,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_ADD_TAGS, $params);
    }

    public function complete($taskId, $listId, $taskSeriesId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_COMPLETE, $params);
    }

    public function delete($taskId, $listId, $taskSeriesId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_DELETE, $params);
    }

    public function getList($filter = null, $listId = null, $lastSync = null)
    {
        $params = array(
            'filter'    => $filter,
            'list_id'   => $listId,
            'last_sync' => $lastSync
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_GET_LIST, $params)->getTasks()->getList();
    }

    public function movePriority($direction, $taskId, $listId, $taskSeriesId, $timeline = 0)
    {
        $params = array(
            'direction'     => $direction,
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_MOVE_PRIORITY, $params);
    }

    public function moveTo($taskId, $fromListId, $toListId, $taskSeriesId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'from_list_id'  => $fromListId,
            'to_list_id'    => $toListId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_MOVE_TO, $params);
    }

    public function postpone($taskId, $listId, $taskSeriesId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_POSTPONE, $params);
    }

    public function removeTags($taskId, $listId, $taskSeriesId, $tags, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => $tags,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_REMOVE_TAGS, $params);
    }

    public function setDueDate($taskId, $listId, $taskSeriesId, $due = null, $hasDueTime = null, $parse = 0, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'due'           => $due,
            'has_due_time'  => $hasDueTime,
            'parse'         => $parse,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_DUE_DATE, $params);
    }

    public function setEstimate($taskId, $listId, $taskSeriesId, $estimate = null, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'estimate'      => $estimate,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_ESTIMATE, $params);
    }

    public function setLocation($taskId, $listId, $taskSeriesId, $locationId = null, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'location_id'   => $locationId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_LOCATION, $params);
    }

    public function setName($taskId, $listId, $taskSeriesId, $name, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'name'          => $name,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_NAME, $params);
    }

    public function setPriority($taskId, $listId, $taskSeriesId, $priority = null, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'priority'      => $priority,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_PRIORITY, $params);
    }

    public function setRecurrence($taskId, $listId, $taskSeriesId, $repeat = null, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'repeat'        => $repeat,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_RECURRENCE, $params);
    }

    public function setTags($taskId, $listId, $taskSeriesId, $tags = null, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => $tags,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_TAGS, $params);
    }

    public function setUrl($taskId, $listId, $taskSeriesId, $url = null, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'url'           => $url,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_SET_URL, $params);
    }

    public function uncomplete($taskId, $listId, $taskSeriesId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_UNCOMPLETE, $params);
    }
}
