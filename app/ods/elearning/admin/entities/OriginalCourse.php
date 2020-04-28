<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Courses\Course as OriginalCourseModel;

class OriginalCourse
{
    /** @var OriginalCourseModel */
    public $instance;

    public function __construct(OriginalCourseModel $course)
    {
        $this->instance = $course;
    }

    /** @return OriginalCourseModel */
    public function getInstance(){
        return $this->instance;
    }

    public function releaseLock(){
        $this->instance->lock = false;
    }

    public function submissionProcessDone(){
        $this->instance->setNoModifier();
        $this->releaseLock();
    }

    public function hasAccepted() : bool
    {
        return $this->instance->acceptedCourse != null;
    }

    public function getAccepted() : AcceptedCourse
    {
        return new AcceptedCourse($this->instance->acceptedCourse);
    }
}
