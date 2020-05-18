<?php


namespace App\Ods\Common\Entities;


class BaseEntity
{
    protected $id;

    /**
     * @var String
     */
    protected $deletedAt;
    /**
     * @var String
     */
    protected $createdAt;
    /**
     * @var String
     */
    protected $updatedAt;

    /**
     * BaseEntity constructor.
     * @param $id
     * @param String $deletedAt
     * @param String $createdAt
     * @param String $updatedAt
     */
    public function __construct($id, String $deletedAt, String $createdAt, String $updatedAt)
    {
        $this->id = $id;
        $this->deletedAt = $deletedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
