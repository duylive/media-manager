<?php

namespace VCComponent\Laravel\MediaManager\Services;

use VCComponent\Laravel\MediaManager\Entities\Media as BaseMediaModel;
use VCComponent\Laravel\MediaManager\Services\MediaQueryTrait;

class Media
{
    use MediaQueryTrait;

    public $query;

    public function __construct()
    {
        $this->query = new BaseMediaModel;
    }

    public function get_media_id($model_id)
    {
        return $this->getMediaModelId($model_id);
    }

    public function get_media_type($model_type)
    {
        return $this->getMediaModelType($model_type);
    }

    public function get_media_collection_name($collection_name)
    {
        return $this->getMediaCollectionName($collection_name);
    }

    public function get_all_media_in_collection_by_id($model_id, $collection_name)
    {
        return $this->getAllMediaInCollectionById($model_id, $collection_name);
    }

    public function get_all_media_in_collection_by_type($model_type, $collection_name)
    {
        return $this->getAllMediaInCollectionByType($model_type, $collection_name);
    }
}



