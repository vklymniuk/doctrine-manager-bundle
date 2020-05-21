<?php

namespace VK\DoctrineManagerBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Extend entity to use active field.
 */
trait EnabledEntityTrait
{
    /**
     * Active?
     *
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled = false;

    /**
     * @param bool $active
     *
     * @return EnabledEntityTrait
     */
    public function setEnabled(bool $active): self
    {
        $this->enabled = $active;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
