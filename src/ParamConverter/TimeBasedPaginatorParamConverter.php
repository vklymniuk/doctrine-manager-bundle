<?php

namespace VK\DoctrineManagerBundle\ParamConverter;

use VK\DoctrineManagerBundle\Paginate\Adapter\AdapterFactory;
use VK\DoctrineManagerBundle\Paginate\TimeBasedPaginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Param converter for pagination
 */
class TimeBasedPaginatorParamConverter implements ParamConverterInterface
{
    /**
     * @var int
     */
    private $limit;

    /**
     * @var string
     */
    private $defaultAdapter;

    /**
     * @var AdapterFactory
     */
    private $pagingAdapterFactory;

    /**
     * @param int    $limit
     * @param string $defaultAdapter
     */
    public function __construct(int $limit, string $defaultAdapter)
    {
        $this->limit = $limit;
        $this->defaultAdapter = $defaultAdapter;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === TimeBasedPaginator::class;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request                        $request
     * @param \Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter $configuration
     *
     * @return bool
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        $name = $configuration->getName();
        $value = $request->attributes->get($name, false);
        $options = $configuration->getOptions();
        if (null === $value) {
            $configuration->setIsOptional(true);
        }

        $adapter = $this->pagingAdapterFactory->create(
            \sprintf('%s_timebased', $options['adapter'] ?? $this->defaultAdapter)
        );

        $object = new TimeBasedPaginator(
            $adapter,
            $request->query->get('since'),
            $request->query->get('until'),
            $request->query->getInt('limit', $this->limit)
        );

        $request->attributes->set($name, $object);

        return true;
    }

    /**
     * @param \VK\DoctrineManagerBundle\Paginate\Adapter\AdapterFactory $pagingAdapterFactory
     */
    public function setPagingAdapterFactory(AdapterFactory $pagingAdapterFactory)
    {
        $this->pagingAdapterFactory = $pagingAdapterFactory;
    }
}
