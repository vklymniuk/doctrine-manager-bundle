<?php

namespace VK\DoctrineManagerBundle\Manager;

use VK\DoctrineSpecification\LazySpecificationCollection;
use VK\DoctrineSpecification\ResultTransformer\ResultTransformerInterface;
use VK\DoctrineSpecification\SpecificationInterface;

/**
 * Base manager
 */
interface ManagerInterface
{
    /**
     * @param SpecificationInterface          $specification
     * @param ResultTransformerInterface|null $resultTransformer
     *
     * @return LazySpecificationCollection
     */
    public function find(
        SpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null
    ): LazySpecificationCollection;

    /**
     * @param SpecificationInterface $specification
     *
     * @return object|null
     */
    public function findOne(SpecificationInterface $specification): ?object;

    /**
     * Returns Entity class which manager works
     *
     * @return string
     */
    public function supports(): string;
}
