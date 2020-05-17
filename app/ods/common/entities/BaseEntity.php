<?php


namespace App\Ods\Common\Entities;


class BaseEntity
{
    protected $id;

    protected $deletedAt;
    protected $createdAt;
    protected $updatedAt;

    /**
     * BaseEntity constructor.
     * @param $id
     * @param $deletedAt
     * @param $createdAt
     * @param $updatedAt
     */
    protected function __construct($id, $deletedAt, $createdAt, $updatedAt)
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
