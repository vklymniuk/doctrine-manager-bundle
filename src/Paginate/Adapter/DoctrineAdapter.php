<?php

namespace VK\DoctrineManagerBundle\Paginate\Adapter;

use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use VK\DoctrineSpecification\LazySpecificationCollection;

/**
 * Doctrine adapter for paginator
 */
class DoctrineAdapter implements AdapterInterface
{
    /**
     * @var int
     */
    private $total;

    /**
     * {@inheritdoc}
     */
    public function paginate(AbstractLazyCollection $collection, int $offset, int $limit): AbstractLazyCollection
    {
        if (!($collection instanceof LazySpecificationCollection)) {
            throw new \InvalidArgumentException(sprintf(
                'The collection MUST extend "%s"',
                LazySpecificationCollection::class
            ));
        }

        $collection->getSpecification()->offset($offset);
        $collection->getSpecification()->limit($limit);

        //@todo remove doctrine paginator
        $paginator = new DoctrinePaginator($collection->getQueryBuilder(), false);
        $this->total = \count($paginator);

        return $collection;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
