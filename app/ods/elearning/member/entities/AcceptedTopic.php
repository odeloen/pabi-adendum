<?php

namespace App\Ods\Elearning\Member\Entities;

use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic as AcceptedTopicModel;

class AcceptedTopic
{
    /** @var AcceptedTopicModel */
    public $instance;

    public function __construct(AcceptedTopicModel $topic){
        $this->instance = $topic;
    }
}
