<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Notes extends AbstractService
{
    public function add($listId, $taskSeriesId, $taskId, $noteTitle, $noteText, $timeline = 0)
    {
        $params = array(
            'list_id'       => $listId,
            'taskseries_id' => $taskSeriesId,
            'task_id'       => $taskId,
            'note_title'    => $noteTitle,
            'note_text'     => $noteText,
            'timeline'      => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_NOTES_ADD, $params);
    }

    public function delete($noteId, $timeline = 0)
    {
        $params = array(
            'note_id'  => $noteId,
            'timeline' => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_NOTES_DELETE, $params);
    }

    public function edit($noteId, $noteTitle, $noteText, $timeline = 0)
    {
        $params = array(
            'note_id'    => $noteId,
            'note_title' => $noteTitle,
            'note_text'  => $noteText,
            'timeline'   => $timeline
        );

        return $this->rtm->call(Rtm::METHOD_NOTES_EDIT, $params);
    }
}