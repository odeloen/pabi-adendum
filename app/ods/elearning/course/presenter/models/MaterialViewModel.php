<?php


namespace App\Ods\Elearning\Course\Presenter\Models;


use App\Ods\Common\Datetime\DateTimeToString;
use App\Ods\Elearning\Common\Modifier\ActionModifierViewTrait;
use App\Ods\Elearning\Course\Constant\MaterialType;
use App\Ods\Elearning\Course\Domain\Entities\Material;

class MaterialViewModel
{
    use DateTimeToString;
    use ActionModifierViewTrait;

    public $id;
    public $name;
    public $description;

    public $type;
    public $content;

    public $public;

    public $created_at;
    public $updated_at;

    public $created_at_string;
    public $updated_at_string;

    public function __construct(Material $materialDomainModel)
    {
        $this->id = $materialDomainModel->getId();
        $this->name = $materialDomainModel->getName();
        $this->description = $materialDomainModel->getDescription();

        $this->type = $materialDomainModel->getType();
        $this->content = $materialDomainModel->getContent();

        $this->public = $materialDomainModel->getPublic();

        $this->modifier = $materialDomainModel->getModifier();

        $this->created_at = $materialDomainModel->getCreatedAt();
        $this->updated_at = $materialDomainModel->getUpdatedAt();
        $this->created_at_string = $this->convertTimeToString($materialDomainModel->getCreatedAt());
        $this->updated_at_string = $this->convertTimeToString($materialDomainModel->getUpdatedAt());
    }

    /**
     * @return string
     */
    public function getIcon(){
        if ($this->type == MaterialType::Post){
            return 'icon-file-text2';
        } else if ($this->type == MaterialType::File) {
            return 'icon-file-pdf';
        } else if ($this->type == MaterialType::Video) {
            return 'icon-file-play';
        }
    }

    /**
     * @return string
     */
    public function getView(){
        if ($this->type == MaterialType::Post){
            return 'post';
        } else if ($this->type == MaterialType::File) {
            return 'pdf';
        } else if ($this->type == MaterialType::Video) {
            return 'video';
        }
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->public;
    }
}
