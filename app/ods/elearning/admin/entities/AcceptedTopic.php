<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic as AcceptedTopicModel;
use Ramsey\Uuid\Uuid;

class AcceptedTopic
{
    /** @var AcceptedTopicModel */
    public $instance;

    public function __construct(AcceptedTopicModel $topic)
    {
        $this->instance = $topic;
    }

    /** @return AcceptedTopicModel */
    public function getInstance(){
        return $this->instance;
    }

    public static function createFromSubmitted(SubmittedTopic $topic, AcceptedCourse $course) : AcceptedTopic
    {
        $acceptedTopic =  new AcceptedTopicModel();
        $acceptedTopic->id = Uuid::uuid4()->toString();

        $acceptedTopic->accepted_course_id = $course->instance->id;
        $acceptedTopic->original_topic_id = $topic->instance->original_topic_id;
        $acceptedTopic->name = $topic->instance->name;
        $acceptedTopic->description = $topic->instance->description;

        $acceptedTopic = new AcceptedTopic($acceptedTopic);

        return $acceptedTopic;
    }
}
