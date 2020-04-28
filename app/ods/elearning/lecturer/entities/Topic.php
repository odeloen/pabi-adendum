<?php

namespace App\Ods\Elearning\Lecturer\Entities;

use App\Ods\Elearning\Core\Entities\Topics\SubmittedTopic as SubmittedTopicModel;
use App\Ods\Elearning\Core\Entities\Topics\Topic as OriginalTopic;
use Ramsey\Uuid\Uuid;

class Topic
{
    /** @var OriginalTopic */
    public $instance;

    public function __construct(OriginalTopic $topic){
        $this->instance = $topic;
    }

    /** @return OriginalTopic */
    public function getInstance() : OriginalTopic{
        return $this->instance;
    }

    public static function create($courseID, $name, $description){
        $topic = new OriginalTopic();
        $topic->id = Uuid::uuid4()->toString();
        $topic->course_id = $courseID;
        $topic->name = $name;
        $topic->description = $description;
        $topic->setCreated();

        return new Topic($topic);
    }

    public function update($name, $description){
        $this->instance->name = $name;
        $this->instance->description = $description;
        $this->instance->setUpdated();
    }

    public function delete(){
        if ($this->instance->isCreated()) {
            return true;
        } else  {
            $this->instance->setDeleted();
            return false;
        }
    }

    public function makeSubmitCopy(SubmittedCourse $submittedCourse){
        $submission = new SubmittedTopicModel();
        $submission->id = Uuid::uuid4()->toString();
        $submission->original_topic_id = $this->instance->id;
        $submission->submitted_course_id = $submittedCourse->instance->id;
        $submission->name = $this->instance->name;
        $submission->description = $this->instance->description;
        $submission->modifier = $this->instance->getActionID();

        return new SubmittedTopic($submission);
    }
}
