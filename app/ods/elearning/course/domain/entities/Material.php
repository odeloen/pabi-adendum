<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


use App\Ods\Common\Entities\BaseEntity;
use App\Ods\Elearning\Common\Modifier\ActionModifierDomainTrait;
use phpDocumentor\Reflection\Types\Boolean;

class Material extends BaseEntity
{
    use ActionModifierDomainTrait;

    /**
     * @var String $topicID
     */
    private $topicID;

    /**
     * @var String $name
     */
    private $name;

    /**
     * @var String $description
     */
    private $description;

    /**
     * @var String $type
     */
    private $type;

    /**
     * @var String $content
     */
    private $content;

    /**
     * @var Boolean $public
     */
    private $public;

    /**
     * Material constructor.
     */
    protected function __construct()
    {
    }



    public static function createFromExisting(
        String $id,
        String $topicID,
        String $name,
        String $description,
        String $type,
        String $content,
        Boolean $public
    ){
        $material = new Material();

        $material->id = $id;
        $material->topicID = $topicID;
        $material->name = $name;
        $material->description = $description;
        $material->type = $type;
        $material->content = $content;
        $material->public = $public;

        return $material;
    }

    public static function createNewMaterial(
        String $topicID,
        String $name,
        String $description,
        String $type,
        String $content,
        Boolean $public
    ){
        $material = new Material();

        $material->topicID = $topicID;
        $material->name = $name;
        $material->description = $description;
        $material->type = $type;
        $material->content = $content;
        $material->public = $public;

        $material->markCreated();

        return $material;
    }

    public function update(
        String $name,
        String $description,
        String $content,
        Boolean $public
    ){
        $this->name = $name;
        $this->description = $description;
        $this->content = $content;
        $this->public = $public;

        $this->markUpdated();
    }
}
