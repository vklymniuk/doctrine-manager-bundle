<?php

namespace VK\DoctrineManagerBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * Extend entity to using UUID.
 */
trait EntityUUIDTrait
{
    /**
     * ID
     *
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    protected $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id->toString();
    }

    /**
     * @param UuidInterface $uuid
     *
     * @return $this
     */
    public function setId(UuidInterface $uuid)
    {
        $this->id = $uuid;

        return $this;
    }
}
