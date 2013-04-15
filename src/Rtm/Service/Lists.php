<?php

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
