<?php

namespace VCComponent\Laravel\MediaManager\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use VCComponent\Laravel\MediaManager\HasMediaTrait;

class MediaItem extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'url',
    ];
}
