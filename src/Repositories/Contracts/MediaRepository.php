<?php

namespace VCComponent\Laravel\MediaManager\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MediaRepository extends RepositoryInterface
{
    public function createMedia($url, $collection = null);
    public function findById($id);
    public function findByModelId($model_id);
    public function findByModelType($model_type);
//    public function findByCollectionName($collection_name);
    public function findByModelDimension($dimension_schema_name);
    public function deleteById($id);
}
