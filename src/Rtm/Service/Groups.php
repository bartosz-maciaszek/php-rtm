<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Groups extends AbstractService
{
    public function add($group, $timeline = 0)
    {
        $params = array(
            'group'    => $group,
            'timeline' => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_GROUPS_ADD, $params);
    }

    public function addContact($groupId, $contactId, $timeline = 0)
    {
        $params = array(
            'group_id'   => $group,
            'contact_id' => $contactId,
            'timeline'   => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_GROUPS_ADD_CONTACT, $params);
    }

    public function delete($groupId, $timeline = 0)
    {
        $params = array(
            'group_id' => $groupId,
            'timeline' => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_GROUPS_DELETE, $params);
    }

    public function getList()
    {
        return $this->rtm->get(Rtm::METHOD_GROUPS_GET_LIST)->getGroups();
    }

    public function removeContact($groupId, $contactId, $timeline = 0)
    {
        $params = array(
            'group_id'   => $group,
            'contact_id' => $contactId,
            'timeline'   => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_GROUPS_REMOVE_CONTACT, $params);
    }
}