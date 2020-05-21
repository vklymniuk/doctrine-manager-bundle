<?php

namespace VK\DoctrineManagerBundle\Manager;

use VK\DoctrineManagerBundle\DependencyInjection\EntityManagerAwareTrait;
use VK\DoctrineManagerBundle\DependencyInjection\EventDispatcherAwareTrait;

use VK\DoctrineSpecification\EntitySpecificationRepository;
use VK\DoctrineSpecification\LazySpecificationCollection;
use VK\DoctrineSpecification\ResultTransformer\ResultTransformerInterface;
use VK\DoctrineSpecification\SpecificationInterface;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AbstractManager
 */
abstract class AbstractManager implements ManagerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * PaymentsManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function supports(): string;

    /**
     * {@inheritdoc}
     */
    public function find(
        SpecificationInterface $specification,
        ResultTransformerInterface $resultTransformer = null
    ): LazySpecificationCollection {
        return $this->getRepository()->match($specification, $resultTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function findOne(SpecificationInterface $specification): ?object
    {
        return $this->getRepository()->matchOneOrNullResult($specification);
    }

    /**
     * @return EntitySpecificationRepository
     */
    abstract protected function getRepository(): EntitySpecificationRepository;
}


