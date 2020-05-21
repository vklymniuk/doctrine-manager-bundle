<?php

namespace VK\DoctrineManagerBundle\Specification;

use Doctrine\ORM\QueryBuilder;
use VK\DoctrineSpecification\SpecificationApplier;
use VK\DoctrineSpecification\SpecificationInterface;

/**
 * Class ImmutableSpecApplier
 */
class ImmutableSpecApplier extends SpecificationApplier
{
    /**
     * {@inheritdoc}
     */
    public static function apply(
        SpecificationInterface $specification,
        QueryBuilder $queryBuilder,
        string $alias = null
    ): void {
        if ($specification instanceof ImmutableSpecInterface) {
            $specification = $specification->getSpec();
        }

        parent::apply($specification, $queryBuilder, $alias);
    }
}