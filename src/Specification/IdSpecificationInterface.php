<?php

namespace VK\DoctrineManagerBundle\Specification;

/**
 * Interface IdSpecificationInterface
 */
interface IdSpecificationInterface extends BaseSpecInterface
{
    /**
     * @param string $id
     *
     * @return IdSpecificationInterface
     */
    public function applyId(string $id): IdSpecificationInterface;
}
