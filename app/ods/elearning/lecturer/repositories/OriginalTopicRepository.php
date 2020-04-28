<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Core\Entities\Topics\Topic as OriginalTopic;
use App\Ods\Elearning\Lecturer\Entities\Course;
use App\Ods\Elearning\Lecturer\Entities\Topic;
use Illuminate\Support\Collection;

class OriginalTopicRepository
{
    public function create($courseID, $name, $description) : Topic
    {
        $topic = Topic::create($courseID, $name, $description);
        return $topic;
    }

    public function all() : Collection
    {
        $originalTopics = OriginalTopic::all();
        foreach ($originalTopics as $originalTopic) {
            $originalTopic->created_at_string = $originalTopic->getCreatedAt();
            $originalTopic->updated_at_string = $originalTopic->getUpdatedAt();
        }

        $topics = [];
        foreach ($originalTopics as $originalTopic) {
            $topic = new Topic($originalTopic);
            $topics[] = $topic;
        }
        return collect($topics);
    }

    public function findByCourse(Course $course) : Collection
    {
        $originalTopics = $course->getInstance()->topics;
        foreach ($originalTopics as $originalTopic) {
            $originalTopic->created_at_string = $originalTopic->getCreatedAt();
            $originalTopic->updated_at_string = $originalTopic->getUpdatedAt();
        }

        $topics = [];
        foreach ($originalTopics as $originalTopic) {
            $topic = new Topic($originalTopic);
            $topics[] = $topic;
        }
        return collect($topics)->sortBy('instance.created_at');
    }

    public function find(string $id) : Topic
    {
        $originalTopic = Originaltopic::find($id);
        $originalTopic->created_at_string = $originalTopic->getCreatedAt();
        $originalTopic->updated_at_string = $originalTopic->getUpdatedAt();

        $topic = new Topic($originalTopic);
        return $topic;
    }

    public function save(Topic $topic) : void
    {
        $topic->getInstance()->save();
        return;
    }

    public function delete(Topic $topic) : void
    {
        $topic->getInstance()->delete();
    }
}
