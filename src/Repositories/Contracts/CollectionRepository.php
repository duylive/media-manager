<?php

namespace VCComponent\Laravel\MediaManager\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CollectionRepository extends RepositoryInterface
{
    public function findById($id);
    public function updateById($data, $id);
    public function deleteById($id);
}
