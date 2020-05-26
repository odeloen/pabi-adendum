<?php


namespace App\Ods\Elearning\Course\Presenter\Models;


use App\Ods\Elearning\Course\Domain\Application\Material\GetMaterialDetailDTO;

class MaterialDetailViewModel
{
    /** @var CourseViewModel */
    public $course;
    /** @var TopicViewModel */
    public $topic;
    /** @var MaterialViewModel */
    public $material;

    public function __construct(GetMaterialDetailDTO $materialDetailDTO)
    {
        $courseDomainModel = $materialDetailDTO->getCourse();
        $topicDomainModel = $materialDetailDTO->getTopic();
        $materialDomainModel = $materialDetailDTO->getMaterial();

        $this->course = new CourseViewModel($courseDomainModel);
        $this->topic = new TopicViewModel($topicDomainModel);

        if (isset($materialDomainModel))$this->material = new MaterialViewModel($materialDomainModel);
    }
}
