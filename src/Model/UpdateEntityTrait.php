<?php

namespace VK\DoctrineManagerBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Extend entity to create data field.
 */
trait UpdateEntityTrait
{
    /**
     * Created At
     *
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @param \DateTimeInterface $dateTime
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTimeInterface $dateTime)
    {
        $this->updatedAt = $dateTime;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
}
