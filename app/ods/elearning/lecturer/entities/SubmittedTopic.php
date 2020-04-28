<?php

namespace App\Ods\Elearning\Lecturer\Entities;

use App\Ods\Elearning\Core\Entities\Topics\SubmittedTopic as SubmittedTopicModel;

class SubmittedTopic
{
    public $instance;

    public function __construct(SubmittedTopicModel $course)
    {
        $this->instance = $course;
    }

    public function getInstance(){
        return $this->instance;
    }
}
