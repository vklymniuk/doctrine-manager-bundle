## Install

```bash
$ composer require vklymniuk/doctrine-manager-bundle
```

Register the bundle:

```php
// config/bundles.php

return [
    ...
     VK\DoctrineManagerBundle\VKDoctrineManagerBundle::class => ['all' => true],
];
```

Edit your doctrine settings
```yaml
doctrine:
    orm:
        default_repository_class: VK\DoctrineSpecification\EntitySpecificationRepository
```
Configure your pagination limit

```yaml
parameters:
  api_pagination_limit: "%env(APP__PAGINATION_LIMIT)%"
```

```php
<?php

namespace App\Specification;

use VK\DoctrineManagerBundle\Specification\BaseSpecInterface;
use VK\DoctrineManagerBundle\Utils\UuidHelper;
use VK\DoctrineSpecification\Specification;

/**
 * Class GarbageCollectorSpecification
 */
class GarbageCollectorSpecification extends Specification implements BaseSpecInterface
{
    /**
     * {@inheritdoc}
     */
    public static function create(): BaseSpecInterface
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public function setId(string $id): BaseSpecInterface
    {
        $this->andWhere(self::expr()->eq('id', UuidHelper::decode($id)));

        return $this;
    }

    /**
     * @param \DateTimeInterface $from
     *
     * @return BaseSpecInterface
     */
    public function setCreated(\DateTimeInterface $from): BaseSpecInterface
    {
        $this->andWhere(self::expr()->lte('createdAt', $from));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function applyWhere(): BaseSpecInterface
    {
        $this->leftJoin('transactions', 'tx');
        $this->andWhere(self::expr()->isNull('id', 'tx'));

        return $this;
    }

    /**
     * @return BaseSpecInterface
     */
    public function applyOrder(): BaseSpecInterface
    {
        return $this;
    }
}

/** @var SpecificationInterface $spec */
$spec = GarbageCollectorSpecification::create()
    ->setCreated($from)
    ->applyWhere();

$payments = $this->paymentsManager->find($spec);

```