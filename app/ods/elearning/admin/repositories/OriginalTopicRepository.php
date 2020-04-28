<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Topics\Topic as OriginalTopicModel;
use App\Ods\Elearning\Admin\Entities\OriginalTopic;
use App\Ods\Elearning\Admin\Entities\SubmittedTopic;

class OriginalTopicRepository
{
    public function find(string $id) : OriginalTopic
    {
        $topic = OriginalTopicModel::find($id);
        $topic = new OriginalTopic($topic);
        return $topic;
    }

    public function findBySubmission(SubmittedTopic $submittedTopic) : OriginalTopic
    {
        $originalTopic = $submittedTopic->instance->origin;
        return new OriginalTopic($originalTopic);
    }

    public function save(OriginalTopic $topic) : void
    {
        $topic->getInstance()->save();
        return;
    }

    public function delete(OriginalTopic $topic) : void
    {
        $topic->getInstance()->delete();
    }
}
