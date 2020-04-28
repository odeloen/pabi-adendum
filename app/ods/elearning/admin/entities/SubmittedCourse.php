<?php

namespace App\Ods\Elearning\Admin\Entities;

use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourse as AcceptedCourseModel;
use App\Ods\Elearning\Core\Entities\Courses\AcceptedCourseCategory;
use App\Ods\Elearning\Core\Entities\Courses\SubmittedCourse as SubmittedCourseModel;
use Ramsey\Uuid\Uuid;

class SubmittedCourse
{
    /** @var SubmittedCourseModel */
    public $instance;

    public function __construct($course)
    {
        $this->instance = $course;
    }

    /** @return SubmittedCourseModel */
    public function getInstance(){
        return $this->instance;
    }

    public function setAccepted()
    {
        $this->instance->setAccepted();
    }

    public function setDeclined($comment)
    {
        $this->setComment($comment);
        $this->instance->setDeclined();
    }

    public function original() : OriginalCourse
    {
        return new OriginalCourse($this->instance->origin);
    }

    public function setComment($comment) : void
    {
        $this->instance->comment = $comment;
    }
}
