<?php

namespace App\Ods\Elearning\Member\Repositories;

use App\Ods\Elearning\Core\Entities\Topics\AcceptedTopic as AcceptedTopicModel;
use App\Ods\Elearning\Member\Entities\AcceptedCourse;
use App\Ods\Elearning\Member\Entities\AcceptedTopic;

class AcceptedTopicRepository
{
    public function find(string $id) : AcceptedTopic
    {
        $acceptedTopic = AcceptedTopicModel::find($id);
        $acceptedTopic->created_at_string = $acceptedTopic->getCreatedAt();
        $acceptedTopic->updated_at_string = $acceptedTopic->getUpdatedAt();

        $topic = new AcceptedTopic($acceptedTopic);

        return $topic;
    }

    public function findByCourse(AcceptedCourse $acceptedCourse){
        $acceptedTopics = $acceptedCourse->instance->topics;
        foreach ($acceptedTopics as $acceptedTopic) {
            $acceptedTopic->created_at_string = $acceptedTopic->getCreatedAt();
            $acceptedTopic->updated_at_string = $acceptedTopic->getUpdatedAt();
        }

        $topics = [];
        foreach ($acceptedTopics as $acceptedTopic) {
            $topic = new AcceptedTopic($acceptedTopic);
            $topics[] = $topic;
        }
        return collect($topics)->sortBy('instance.created_at');
    }
}
