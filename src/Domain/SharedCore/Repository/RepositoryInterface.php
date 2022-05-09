<?php

namespace Core\Domain\SharedCore\Repository;

use Core\Domain\SharedCore\Entity\EntityAbstract;

interface RepositoryInterface
{
    public function create(EntityAbstract $entity): void;
    public function update(EntityAbstract $entity): void;
    public function find(string $id): EntityAbstract;
    public function findAll(): array;
}
