<?php

namespace VK\DoctrineManagerBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Extend entity to using id.
 */
trait EntityIdTrait
{
    /**
     * ID
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }
}
