<?php

namespace Rtm\Service;

use Rtm\Rtm;

class Transactions extends AbstractService
{
    public function undo($transactionId, $timeline = 0)
    {
        $params = array(
            'transaction_id' => $transactionId,
            'timeline'       => $timeline
        );

        return $this->rtm->get(Rtm::METHOD_TRANSACTIONS_UNDO, $params);
    }
}