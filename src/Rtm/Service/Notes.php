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

class Notes extends AbstractService
{
    /**
     * Adds a new note to a task.
     * @param integer $listId
     * @param integer $taskSeriesId
     * @param integer $taskId
     * @param string  $noteTitle
     * @param string  $noteText
     * @param integer $timeline
     * @return DataConteiner
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.notes.add.rtm
     */
    public function add($listId, $taskSeriesId, $taskId, $noteTitle, $noteText, $timeline = null)
    {
        $params = array(
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'task_id'       => $taskId,
            'note_title'    => $noteTitle,
            'note_text'     => $noteText,
            'timeline'      => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_NOTES_ADD, $params);
    }

    /**
     * Deletes a note.
     * @param  integer $noteId
     * @param  integer $timeline
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.notes.delete.rtm
     */
    public function delete($noteId, $timeline = null)
    {
        $params = array(
            'note_id'  => $noteId,
            'timeline' => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_NOTES_DELETE, $params);
    }

    /**
     * Modifies a note.
     * @param  integer $noteId    [description]
     * @param  string  $noteTitle [description]
     * @param  string  $noteText  [description]
     * @param  integer $timeline  [description]
     * @return DataContainer
     * @link https://www.rememberthemilk.com/services/api/methods/rtm.tasks.notes.edit.rtm
     */
    public function edit($noteId, $noteTitle, $noteText, $timeline = null)
    {
        $params = array(
            'note_id'    => $noteId,
            'note_title' => $noteTitle,
            'note_text'  => $noteText,
            'timeline'   => $timeline === null ? $this->getTimeline() : $timeline
        );

        return $this->rtm->call(Rtm::METHOD_NOTES_EDIT, $params);
    }
}
