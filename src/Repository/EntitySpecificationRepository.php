<?php

namespace VK\DoctrineManagerBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use VK\DoctrineManagerBundle\Specification\ImmutableSpecApplier;
use VK\DoctrineSpecification\EntitySpecificationRepository as BaseEntitySpecificationRepository;
use VK\DoctrineSpecification\SpecificationInterface;

/**
 * Class EntitySpecificationRepository
 */
class EntitySpecificationRepository extends BaseEntitySpecificationRepository
{
    /**
     * @var string alias
     */
    private $alias = 'e';

    /**
     * {@inheritdoc}
     */
    public function getQueryBuilder(SpecificationInterface $specification): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder($this->alias);

        //apply specification to the query builder
        ImmutableSpecApplier::apply(clone $specification, $queryBuilder, $this->getAlias());

        return $queryBuilder;
    }
}