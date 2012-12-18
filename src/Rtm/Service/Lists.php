<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Lists extends AbstractService
{
    public function add($name, $filter, $timeline = 0)
    {
        $params = array(
            'name'     => $name,
            'filter'   => $filter,
            'timeline' => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_LISTS_ADD, $params);
    }
}

// rtm.lists.add
// rtm.lists.archive
// rtm.lists.delete
// rtm.lists.getList
// rtm.lists.setDefaultList
// rtm.lists.setName
// rtm.lists.unarchive