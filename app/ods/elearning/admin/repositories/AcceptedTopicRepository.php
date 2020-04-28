<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Admin\Entities\AcceptedCourse;
use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic as AcceptedTopicModel;
use App\Ods\Elearning\Admin\Entities\AcceptedTopic;
use App\Ods\Elearning\Admin\Entities\SubmittedTopic;

class AcceptedTopicRepository
{
    public function create(SubmittedTopic $submittedTopic, AcceptedCourse $acceptedCourse) : AcceptedTopic
    {
        $topic = AcceptedTopic::createFromSubmitted($submittedTopic, $acceptedCourse);
        return $topic;
    }

    public function find(string $id) : AcceptedTopic
    {
        $topic = AcceptedTopicModel::find($id);
        $topic = new AcceptedTopic($topic);
        $topic->categories = $topic->instance->categories;
        return $topic;
    }

    public function findByCourse(AcceptedCourse $acceptedCourse){
        $acceptedTopics = $acceptedCourse->getInstance()->topics;
        $topics = [];
        foreach ($acceptedTopics as $acceptedTopic) {
            $topic = new AcceptedTopic($acceptedTopic);
            $topics[] = $topic;
        }
        return collect($topics)->sortBy('instance.created_at');
    }

    public function save(AcceptedTopic $topic) : void
    {
        $topic->getInstance()->save();
    }

    public function delete(AcceptedTopic $topic) : void
    {
        $topic->getInstance()->delete();
    }
}
