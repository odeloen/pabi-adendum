<?php


namespace App\Ods\Elearning\Course\Presenter\Models;


use App\Ods\Core\Requests\UseCaseResponse;
use App\Ods\Elearning\Course\Domain\Application\Course\GetCourseDetailDTO;

class CourseDetailViewModel
{
    /**
     * @var CourseViewModel $course
     */
    public $course;

    /**
     * @var TopicViewModel[] $topics
     */
    public $topics;

    /**
     * CourseDetailViewModel constructor.
     * @param GetCourseDetailDTO $courseDetailDTO
     */
    public function __construct(GetCourseDetailDTO $courseDetailDTO)
    {
        if (!isset($courseDetailDTO)) return;

        $courseDomainModel = $courseDetailDTO->getCourse();
        $courseViewModel = new CourseViewModel($courseDomainModel);

        $res = [];
        foreach ($courseDetailDTO->getTopics() as $topicDomainModel){
            $topicViewModel = new TopicViewModel($topicDomainModel);
            $res[] = $topicViewModel;
        }
        $topicViewModels = collect($res);

        $this->course = $courseViewModel;
        $this->topics = $topicViewModels;
    }
}
