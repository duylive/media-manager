<?php

namespace VCComponent\Laravel\MediaManager\Transformers;

use League\Fractal\TransformerAbstract;
use VCComponent\Laravel\MediaManager\Entities\Collection;
use VCComponent\Laravel\MediaManager\Transformers\MediaTransformer;

class CollectionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'medias',
    ];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform(Collection $model)
    {
        return [
            'id'          => $model->id,
            'name'        => $model->name,
            'slug'        => $model->slug,
            'description' => $model->description,
            'timestamps'  => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }

    public function includeMedias(Collection $model)
    {
        return $this->collection($model->medias, new MediaTransformer());
    }
}
