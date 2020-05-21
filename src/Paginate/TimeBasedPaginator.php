<?php

namespace VK\DoctrineManagerBundle\Paginate;

use VK\DoctrineManagerBundle\Paginate\Adapter\AdapterInterface;
use VK\DoctrineManagerBundle\Paginate\Adapter\TimeBasedAdapterInterface;

use Doctrine\Common\Collections\AbstractLazyCollection;

/**
 * Class TimeBasedPaginator
 */
class TimeBasedPaginator implements PaginatorInterface
{
    /**
     * @var string
     */
    private $since; //old data

    /**
     * @var string
     */
    private $until; //new data

    /**
     * @var int
     */
    private $limit;

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * DateTimePaginator constructor.
     * @param TimeBasedAdapterInterface $adapter
     * @param null|string               $since
     * @param null|string               $until
     * @param int                       $limit
     */
    public function __construct(TimeBasedAdapterInterface $adapter, ?string $since, ?string $until, int $limit)
    {
        $this->adapter = $adapter;
        $this->until = $until;
        $this->since = $since;
        $this->limit = $limit;
    }

    /**
     * {@inheritdoc}
     */
    public function paginate(AbstractLazyCollection $collection)
    {
        $items = $this->adapter->paginate($collection, $this->since, $this->until, $this->limit);
        $items = $items->toArray();

        $firstElement = reset($items);
        $lastElement = end($items);
        $since = $lastElement ? $lastElement->getCreatedAt()->format('Y-m-d H:i:s') : null;
        $until = $firstElement ? $firstElement->getCreatedAt()->format('Y-m-d H:i:s') : null;

        return [
            'limit'  => $this->limit,
            'since'  => $since,
            'until'  => $until,
            'items'  => $items,
        ];
    }
}
