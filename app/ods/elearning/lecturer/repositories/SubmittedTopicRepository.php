<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Core\Entities\Topics\SubmittedTopic as SubmittedTopicModel;
use App\Ods\Elearning\Lecturer\Entities\SubmittedCourse;
use App\Ods\Elearning\Lecturer\Entities\SubmittedTopic;
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
        $submittedTopic = SubmittedTopicModel::withTrashed()->find($id);
        $submittedTopic->created_at_string = $submittedTopic->getCreatedAt();
        $submittedTopic->updated_at_string = $submittedTopic->getUpdatedAt();

        return new SubmittedTopic($submittedTopic);
    }

    public function findByCourse(SubmittedCourse $course)
    {
        $submittedTopics = SubmittedTopicModel::withTrashed()->where('submitted_course_id', $course->instance->id)->get();
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
}
