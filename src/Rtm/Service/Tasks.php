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

    public function addTags(array $tags, $taskId, $taskSeriesId, $listId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => implode(', ', $tags),
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_ADD_TAGS, $params);
    }

    public function complete($taskId, $taskSeriesId, $listId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_COMPLETE, $params);
    }

    public function delete($taskId, $taskSeriesId, $listId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_DELETE, $params);
    }

    public function getList($listId = null, $filter = null, $lastSync = null)
    {
        $params = array(
            'filter'    => $filter,
            'list_id'   => $listId,
            'last_sync' => $lastSync
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_GET_LIST, $params)->getTasks()->getList();
    }

    public function movePriority($direction, $taskId, $taskSeriesId, $listId, $timeline = 0)
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

    public function moveTo($taskId, $taskSeriesId, $fromListId, $toListId, $timeline = 0)
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

    public function postpone($taskId, $taskSeriesId, $listId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_POSTPONE, $params);
    }

    public function removeTags(array $tags, $taskId, $taskSeriesId, $listId, $timeline = 0)
    {
        $params = array(
            'task_id'       => $taskId,
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'tags'          => implode(', ', $tags),
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_TASKS_REMOVE_TAGS, $params);
    }

//     rtm.tasks.setDueDate
//     rtm.tasks.setEstimate
//     rtm.tasks.setLocation
//     rtm.tasks.setName
//     rtm.tasks.setPriority
//     rtm.tasks.setRecurrence
//     rtm.tasks.setTags
//     rtm.tasks.setURL
//     rtm.tasks.uncomplete
}
