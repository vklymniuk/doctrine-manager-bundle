<?php

namespace VK\DoctrineManagerBundle\Paginate\Adapter;

use Doctrine\Common\Collections\AbstractLazyCollection;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use VK\DoctrineSpecification\LazySpecificationCollection;
use VK\DoctrineSpecification\ResultTransformer\ResultTransformerCollection;
use VK\DoctrineSpecification\ResultTransformer\Reverse;

/**
 * Doctrine adapter for paginator
 */
class DoctrineTimeBasedAdapter implements TimeBasedAdapterInterface
{
    /**
     * @var int
     */
    private $total;

    /**
     * {@inheritdoc}
     */
    public function paginate(AbstractLazyCollection $collection, ?string $since, ?string $until, int $limit): AbstractLazyCollection
    {
        if (!($collection instanceof LazySpecificationCollection)) {
            throw new \InvalidArgumentException(sprintf(
                'The collection MUST extend "%s"',
                LazySpecificationCollection::class
            ));
        }

        $spec = $collection->getSpecification();
        $spec->orderBy('createdAt', 'desc');

        if ($since) {
            $spec->andWhere($spec::expr()->lt('createdAt', \DateTime::createFromFormat('Y-m-d H:i:s.u', $since)));
        }
        if ($until) {
            $spec->orderBy('createdAt', 'asc');
            $spec->andWhere($spec::expr()->gt('createdAt', \DateTime::createFromFormat('Y-m-d H:i:s.u', $until)));
        }

        $collection->getSpecification()->limit($limit);

        //@todo remove doctrine paginator
        $paginator = new DoctrinePaginator($collection->getQueryBuilder(), false);

        if ($until) {
            $transformerCollection = new ResultTransformerCollection($collection->getResultTransformer(), new Reverse());
            $collection->setResultTransformer($transformerCollection);
        }

        return $collection;
    }
}
