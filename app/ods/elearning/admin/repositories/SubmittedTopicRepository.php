<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Topics\SubmittedTopic as SubmittedTopicModel;
use App\Ods\Elearning\Admin\Entities\SubmittedCourse;
use App\Ods\Elearning\Admin\Entities\SubmittedTopic;
use Illuminate\Support\Collection;

class SubmittedTopicRepository
{
    public function all() : Collection
    {
        $submittedTopics = SubmittedTopicModel::all();
        foreach ($submittedTopics as $submittedTopic) {
            $submittedTopic->created_at_string = $submittedTopic->getCreatedAt();
            $submittedTopic->updated_at_string = $submittedTopic->getUpdatedAt();
        }

        $topics = [];
        foreach ($submittedTopics as $submittedTopic) {
            $topic = new SubmittedTopic($submittedTopic);
            $topics[] = $topic;
        }
        return collect($topics)->sortBy('instance.created_at');
    }

    public function find(string $id) : SubmittedTopic
    {
        $submittedTopic = SubmittedTopicModel::find($id);
        $submittedTopic->created_at_string = $submittedTopic->getCreatedAt();
        $submittedTopic->updated_at_string = $submittedTopic->getUpdatedAt();

        return new SubmittedTopic($submittedTopic);
    }

    public function findByCourse(SubmittedCourse $course)
    {
        $submittedTopics = $course->getInstance()->topics;
        foreach ($submittedTopics as $submittedTopic) {
            $submittedTopic->created_at_string = $submittedTopic->getCreatedAt();
            $submittedTopic->updated_at_string = $submittedTopic->getUpdatedAt();
        }

        $topics = [];
        foreach ($submittedTopics as $submittedTopic) {
            $topic = new SubmittedTopic($submittedTopic);
            $topics[] = $topic;
        }
        return collect($topics)->sortBy('instance.created_at');
    }

    public function save(SubmittedTopic $topic) : void
    {
        $topic->instance->save();
        return;
    }

    public function delete(SubmittedTopic $topic) : void
    {
        $topic->getInstance()->delete();
    }
}
