<?php

namespace VK\DoctrineManagerBundle\Paginate;

use Doctrine\Common\Collections\AbstractLazyCollection;

/**
 * Interface PaginatorInterface
 */
interface PaginatorInterface
{
    /**
     * @param AbstractLazyCollection $collection
     *
     * @return mixed
     */
    public function paginate(AbstractLazyCollection $collection);
}