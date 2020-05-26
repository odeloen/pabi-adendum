<?php


namespace App\Ods\Elearning\Course\Domain\Entities;


use App\Ods\Common\Entities\BaseEntity;
use App\Ods\Elearning\Common\Modifier\ActionModifierDomainTrait;

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
     * Associative array for the content with multiple meta-data
     * @var array $content
     */
    private $content;

    /**
     * @var bool $public
     */
    private $public;

    /**
     * Material constructor.
     */
    public function __construct()
    {
    }

    public static function createFromExisting(
        String $id,
        String $topicID,
        String $name,
        String $description = null,
        String $type,
        array $content,
        bool $public,
        int $modifier = null,
        String $deletedAt = null,
        String $createdAt,
        String $updatedAt
    ){
        $material = new Material();

        $material->id = $id;
        $material->topicID = $topicID;
        $material->name = $name;
        $material->description = $description;
        $material->type = $type;
        $material->content = $content;
        $material->public = $public;
        $material->modifier = $modifier;
        $material->deletedAt = $deletedAt;
        $material->createdAt = $createdAt;
        $material->updatedAt = $updatedAt;

        return $material;
    }

    public static function createNewMaterial(
        String $topicID,
        String $name,
        String $description = null,
        String $type,
        array $content,
        bool $public
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
        String $description = null,
        array $content,
        bool $public
    ){
        $this->name = $name;
        $this->description = $description;
        $this->content = $content;
        $this->public = $public;

        $this->markUpdated();
    }

    /**
     * @return String
     */
    public function getTopicID()
    {
        return $this->topicID;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function getPublic()
    {
        return $this->public;
    }
}
