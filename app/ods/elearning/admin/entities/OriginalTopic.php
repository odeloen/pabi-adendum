<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Topics\Topic as OriginalTopicModel;

class OriginalTopic
{
    /** @var OriginalTopicModel */
    public $instance;

    public function __construct(OriginalTopicModel $course)
    {
        $this->instance = $course;
    }

    /** @return OriginalTopicModel */
    public function getInstance(){
        return $this->instance;
    }

    public function submissionProcessDone(){
        $this->instance->setNoModifier();
    }
}
