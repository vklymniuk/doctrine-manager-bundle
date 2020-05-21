<?php

namespace VK\DoctrineManagerBundle\Paginate;

use VK\DoctrineManagerBundle\Paginate\Adapter\AdapterInterface;
use Doctrine\Common\Collections\AbstractLazyCollection;

/**
 * Class OffsetPaginator
 */
class OffsetPaginator implements PaginatorInterface
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * OffsetPaginator constructor.
     *
     * @param AdapterInterface $adapter
     * @param int              $offset
     * @param int              $limit
     */
    public function __construct(AdapterInterface $adapter, int $offset, int $limit)
    {
        $this->adapter = $adapter;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * {@inheritdoc}
     */
    public function paginate(AbstractLazyCollection $collection)
    {
        $items = $this->adapter->paginate($collection, $this->offset, $this->limit);
        $items = $items->toArray();

        return [
            'limit'  => $this->limit,
            'total'  => $this->adapter->getTotal(),
            'offset' => \count($items) + $this->offset,
            'items'  => $items,
        ];
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}
