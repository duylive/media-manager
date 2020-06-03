<?php

namespace VCComponent\Laravel\MediaManager\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MediaRepository extends RepositoryInterface
{
    public function createMedia($url, $collection = null);
    public function findById($id);
    public function deleteById($id);
}
