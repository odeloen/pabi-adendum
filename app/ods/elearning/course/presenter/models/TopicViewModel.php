<?php


namespace App\Ods\Elearning\Course\Presenter\Models;


use App\Ods\Common\Datetime\DateTimeToString;
use App\Ods\Elearning\Common\Modifier\ActionModifierViewTrait;
use App\Ods\Elearning\Course\Domain\Entities\Topic;

class TopicViewModel
{
    use DateTimeToString;
    use ActionModifierViewTrait;

    public $id;
    public $name;
    public $description;

    /**
     * @var MaterialViewModel[] $materials
     */
    public $materials;

    public $created_at;
    public $updated_at;

    public $created_at_string;
    public $updated_at_string;

    public function __construct(Topic $topicDomainModel)
    {
        $this->id = $topicDomainModel->getId();
        $this->name = $topicDomainModel->getName();
        $this->description = $topicDomainModel->getDescription();

        if (!empty($topicDomainModel->getMaterials())){
            $res = [];
            foreach ($topicDomainModel->getMaterials() as $materialDomainModel){
                $materialViewModel = new MaterialViewModel($materialDomainModel);
                $res[] = $materialViewModel;
            }
            $this->materials = collect($res);
        }

        $this->modifier = $topicDomainModel->getModifier();

        $this->created_at = $topicDomainModel->getCreatedAt();
        $this->updated_at = $topicDomainModel->getUpdatedAt();
        $this->created_at_string = $this->convertTimeToString($topicDomainModel->getCreatedAt());
        $this->updated_at_string = $this->convertTimeToString($topicDomainModel->getUpdatedAt());
    }
}
