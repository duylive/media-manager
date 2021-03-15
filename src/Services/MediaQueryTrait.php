<?php

namespace Vccomponent\Laravel\MediaManager\Services;

trait MediaQueryTrait
{
    public function getMediaModelId($model_id)
    {
        return $this->query->where('model_id', $model_id)->get();
    }

    public function getMediaModelType($model_type)
    {
        return $this->query->where('model_type', $model_type)->get();
    }

    public function getMediaCollectionName($collection_name)
    {
        return $this->query->where('collection_name', $collection_name)->get();
    }

    public function getAllMediaInCollectionById($model_id, $collection_name)
    {
        return $this->query->where('model_id', $model_id)->where('collection_name', $collection_name)->get();
    }

    public function getAllMediaInCollectionByType($model_type, $collection_name)
    {
        return $this->query->where('model_type', $model_type)->where('collection_name', $collection_name)->get();
    }
}
