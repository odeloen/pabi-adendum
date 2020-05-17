<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


use App\Ods\Common\Entities\BaseEntity;
use App\Ods\Elearning\Common\Modifier\ActionModifierDomainTrait;

class Topic extends BaseEntity
{
    use ActionModifierDomainTrait;

    /**
     * @var String $courseID
     */
    private $courseID;

    /** @var String $name */
    private $name;

    /** @var String $description */
    private $description;

    /** @var Material[] $materials */
    private $materials;

    /**
     * Topic constructor.
     */
    protected function __construct()
    {
    }

    /**
     * @param String $id
     * @param String $courseID
     * @param String $name
     * @param String $description
     * @param array $materials
     * @return Topic
     */
    public static function createFromExisting(
        String $id,
        String $courseID,
        String $name,
        String $description,
        array $materials = null,
        int $modifier = null
    ){
        $topic = new Topic();

        $topic->id = $id;
        $topic->courseID = $courseID;
        $topic->name = $name;
        $topic->description = $description;
        $topic->materials = $materials;
        $topic->modifier = $modifier;

        return $topic;
    }

    public static function createNewTopic(
        String $courseID,
        String $name,
        String $description
    ){
        $topic = new Topic();

        $topic->courseID = $courseID;
        $topic->name = $name;
        $topic->description = $description;

        $topic->markCreated();

        return $topic;
    }

    public function update(
        String $name,
        String $description
    ){
        $this->name = $name;
        $this->description = $description;

        $this->markUpdated();
    }

    /**
     * @return String
     */
    public function getCourseID(): String
    {
        return $this->courseID;
    }

    /**
     * @return String
     */
    public function getName(): String
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getDescription(): String
    {
        return $this->description;
    }

    /**
     * @return Material[]
     */
    public function getMaterials(): array
    {
        return $this->materials;
    }
}
