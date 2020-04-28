<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse;
use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic;
use App\Ods\Elearning\Core\Entities\Topics\SubmittedTopic as SubmittedTopicModel;

class SubmittedTopic
{
    /** @var SubmittedTopicModel */
    public $instance;

    public function __construct(SubmittedTopicModel $topic)
    {
        $this->instance = $topic;
    }

    public function getInstance() : SubmittedTopicModel
    {
        return $this->instance;
    }

    public function original() : OriginalTopic
    {
        return new OriginalTopic($this->instance->origin);
    }

    public function setDeclined(){
        $this->instance->setDeclined();
    }

    public function setComment($comment) : void
    {
        $this->instance->comment = $comment;
    }
}
