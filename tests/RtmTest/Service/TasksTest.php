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

class TasksTest extends ServiceTestCase
{
    public function getServiceMethodsMatrix()
    {
        return array(

            /** tasks.add */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_ADD,
                array('name' => 'test'),
                array('name' => 'test', 'list_id' => null, 'parse' => 0, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_ADD,
                array('name' => 'test', 'list_id' => 123),
                array('name' => 'test', 'list_id' => 123, 'parse' => 0, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_ADD,
                array('name' => 'test', 'list_id' => 123, 'parse' => 1),
                array('name' => 'test', 'list_id' => 123, 'parse' => 1, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_ADD,
                array('name' => 'test', 'list_id' => 123, 'parse' => 1, 'timeline' => 123),
                array('name' => 'test', 'list_id' => 123, 'parse' => 1, 'timeline' => 123)),
            
            /** tasks.addTags */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_ADD_TAGS,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_ADD_TAGS,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 123)),
            
            /** tasks.complete */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_COMPLETE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_COMPLETE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123)),
            
            /** tasks.delete */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_DELETE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_DELETE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123)),
            
            /** tasks.getList */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_GET_LIST,
                array(),
                array('filter' => null, 'list_id' => null, 'last_sync' => null)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_GET_LIST,
                array('filter' => 'test'),
                array('filter' => 'test', 'list_id' => null, 'last_sync' => null)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_GET_LIST,
                array('filter' => 'test', 'list_id' => 123),
                array('filter' => 'test', 'list_id' => 123, 'last_sync' => null)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_GET_LIST,
                array('filter' => 'test', 'list_id' => 123, 'last_sync' => 123456),
                array('filter' => 'test', 'list_id' => 123, 'last_sync' => 123456)),
            
            /** tasks.movePriority */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_MOVE_PRIORITY,
                array('direction' => 'test', 'task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('direction' => 'test', 'task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_MOVE_PRIORITY,
                array('direction' => 'test', 'task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123),
                array('direction' => 'test', 'task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123)),
            
            /** tasks.moveTo */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_MOVE_TO,
                array('task_id' => 123, 'from_list_id' => 123, 'to_list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'from_list_id' => 123, 'to_list_id' => 123, 'taskseries_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_MOVE_TO,
                array('task_id' => 123, 'from_list_id' => 123, 'to_list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123),
                array('task_id' => 123, 'from_list_id' => 123, 'to_list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123)),
            
            /** tasks.postpone */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_POSTPONE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_POSTPONE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123)),

            /** tasks.removeTags */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_REMOVE_TAGS,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_REMOVE_TAGS,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 123)),

            /** tasks.setDueDate */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_DUE_DATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => null, 'has_due_time' => 0, 'parse' => 0, 'timeline' => null)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_DUE_DATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test', 'has_due_time' => 0, 'parse' => 0, 'timeline' => null)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_DUE_DATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test', 'has_due_time' => 1),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test', 'has_due_time' => 1, 'parse' => 0, 'timeline' => null)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_DUE_DATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test', 'has_due_time' => 1, 'parse' => 1),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test', 'has_due_time' => 1, 'parse' => 1, 'timeline' => null)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_DUE_DATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test', 'has_due_time' => 1, 'parse' => 1, 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'due' => 'test', 'has_due_time' => 1, 'parse' => 1, 'timeline' => 123)),

            /** tasks.setEstimate */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_ESTIMATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'estimate' => null, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_ESTIMATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'estimate' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'estimate' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_ESTIMATE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'estimate' => 'test', 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'estimate' => 'test', 'timeline' => 123)),

            /** tasks.setLocation */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_LOCATION,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'location_id' => null, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_LOCATION,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'location_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'location_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_LOCATION,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'location_id' => 123, 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'location_id' => 123, 'timeline' => 123)),

            /** tasks.setName */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_NAME,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'name' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'name' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_NAME,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'name' => 'test', 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'name' => 'test', 'timeline' => 123)),

            /** tasks.setPriority */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_PRIORITY,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'priority' => null, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_PRIORITY,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'priority' => 1),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'priority' => 1, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_PRIORITY,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'priority' => 1, 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'priority' => 1, 'timeline' => 123)),

            /** tasks.setRecurrence */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_RECURRENCE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'repeat' => null, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_RECURRENCE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'repeat' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'repeat' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_RECURRENCE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'repeat' => 'test', 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'repeat' => 'test', 'timeline' => 123)),

            /** tasks.setTags */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_TAGS,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => null, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_TAGS,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_TAGS,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'tags' => 'test', 'timeline' => 123)),

            /** tasks.setUrl */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_URL,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'url' => null, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_URL,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'url' => 'test'),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'url' => 'test', 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_SET_URL,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'url' => 'test', 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'url' => 'test', 'timeline' => 123)),

            /** tasks.uncomplete */
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_UNCOMPLETE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 0)),
            array(
                Rtm::SERVICE_TASKS,
                Rtm::METHOD_TASKS_UNCOMPLETE,
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123),
                array('task_id' => 123, 'list_id' => 123, 'taskseries_id' => 123, 'timeline' => 123)),
        );
    }
}
