<?php

namespace VK\DoctrineManagerBundle\Paginate\Adapter;

use Doctrine\Common\Collections\AbstractLazyCollection;

/**
 * Class AdapterInterface
 */
interface TimeBasedAdapterInterface
{
    /**
     * @param AbstractLazyCollection $collection
     * @param null|string            $since
     * @param null|string            $until
     * @param int                    $limit
     * @return AbstractLazyCollection
     */
    public function paginate(AbstractLazyCollection $collection, ?string $since, ?string $until, int $limit): AbstractLazyCollection;
}
