<?php

namespace VK\DoctrineManagerBundle\Specification;

use VK\DoctrineSpecification\SpecificationInterface;

/**
 * Interface BaseSpecInterface
 */
interface BaseSpecInterface extends SpecificationInterface
{
    /**
     * @return BaseSpecInterface
     */
    public static function create(): BaseSpecInterface;

    /**
     * @return BaseSpecInterface
     */
    public function applyWhere(): BaseSpecInterface;

    /**
     * @return BaseSpecInterface
     */
    public function applyOrder(): BaseSpecInterface;
}
