<?php

namespace VK\DoctrineManagerBundle\Specification;

use VK\DoctrineSpecification\SpecificationInterface;

/**
 * Interface ImmutableSpecInterface
 */
interface ImmutableSpecInterface extends SpecificationInterface
{
    /**
     * @return SpecificationInterface
     */
    public function getSpec(): SpecificationInterface;
}