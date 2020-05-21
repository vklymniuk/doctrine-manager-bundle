<?php

namespace VK\DoctrineManagerBundle\Paginate\Adapter;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Adapter factory
 */
class AdapterFactory implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var string
     */
    private $preffix;

    /**
     * @param string $preffix
     */
    public function __construct(string $preffix)
    {
        $this->preffix = $preffix;
    }

    /**
     * @param string $name
     *
     * @return AdapterInterface
     */
    public function create(string $name)
    {
        $service = \sprintf($this->preffix.$name);
        if ($this->container->has($service)) {
            return $this->container->get($service);
        }

        throw new \InvalidArgumentException(sprintf('Paginator adapter with key "%s" not found', $service));
    }
}
