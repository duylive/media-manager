<?php

namespace VCComponent\Laravel\MediaManager\Entities;

use Spatie\MediaLibrary\Models\Media as BaseMedia;
use VCComponent\Laravel\MediaManager\Entities\Collection;

class Media extends BaseMedia
{
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_name', 'slug');
    }
}
