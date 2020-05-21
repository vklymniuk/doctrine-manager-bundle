<?php

namespace VK\DoctrineManagerBundle\Paginate\Adapter;

use Doctrine\Common\Collections\AbstractLazyCollection;

/**
 * Class AdapterInterface
 */
interface AdapterInterface
{
    /**
     * @param AbstractLazyCollection $collection
     * @param int                    $offset
     * @param int                    $limit
     *
     * @return \Doctrine\Common\Collections\AbstractLazyCollection
     */
    public function paginate(AbstractLazyCollection $collection, int $offset, int $limit): AbstractLazyCollection;

    /**
     * @return int
     */
    public function getTotal(): int;
}
