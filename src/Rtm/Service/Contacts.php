<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Contacts extends AbstractService
{
    public function add($contact, $timeline = 0)
    {
        $params = array(
            'contact'  => $contact,
            'timeline' => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_CONTACTS_ADD, $params);
    }

    public function delete($id, $timeline = 0)
    {
        $params = array(
            'contact_id' => $id,
            'timeline'   => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_CONTACTS_DELETE, $params);
    }

    public function getList()
    {
        return $this->rtm->get(Rtm::METHOD_CONTACTS_GET_LIST)->getContacts();
    }
}