<?php

namespace VCComponent\Laravel\MediaManager\Http\Controllers\Api;

use Illuminate\Http\Request;
use VCComponent\Laravel\MediaManager\Repositories\Contracts\MediaRepository;
use VCComponent\Laravel\MediaManager\Transformers\MediaTransformer;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;
use VCComponent\Laravel\MediaManager\Facades\Media;

class MediaController extends ApiController
{
    protected $repository;
    protected $entity;
    protected $transformer;

    public function __construct(MediaRepository $repository)
    {
        $this->repository  = $repository;
        $this->entity      = $repository->getEntity();
        $this->transformer = MediaTransformer::class;
    }

    public function index(Request $request)
    {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['name'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        $per_page = (int) $request->has('per_page') ? $request->get('per_page') : 20;

        $medias = $query->paginate($per_page);

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->paginator($medias, $transformer);
    }

    public function all(Request $request)
    {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['name'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        $medias = $query->get();

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->collection($medias, $transformer);
    }

    public function show(Request $request, $id)
    {
        $media = $this->repository->findById($id);

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->item($media, $transformer);
    }
    public function createMedias(Request $request)
    {

        $urls       = $request->input('urls');
        $collection = $request->has('collection') ? $request->input('collection') : null;

        $media = $this->repository->createMedias($urls, $collection);

        return $this->response->collection(collect($media), new $this->transformer());
    }

    public function store(Request $request)
    {
        $url        = $request->input('url');
        $collection = $request->has('collection') ? $request->input('collection') : null;

        $media = $this->repository->createMedia($url, $collection);

        return $this->response->item($media, new $this->transformer());
    }

    public function destroy(Request $request, $id)
    {
        $this->repository->deleteById($id);

        return $this->success();
    }

    public function attachToCollection(Request $request, $id)
    {
        $media = $this->repository->updateCollection($id, $request->input('collection'));
        return $this->response->item($media, new $this->transformer());
    }

    public function detachFromCollection(Request $request, $id)
    {
        $media = $this->repository->updateCollection($id, 'default');
        return $this->response->item($media, new $this->transformer());
    }

    public function getMediaModelId(Request $request, $model_id)
    {
        $getMediaModelId = Media::get_media_id($model_id);

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->collection($getMediaModelId, $transformer);
    }

    public function getMediaModelType(Request $request, $model_type)
    {
        $getMediaModelType = Media::get_media_type($model_type);

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->collection($getMediaModelType, $transformer);
    }

    public function getMediaCollectionName(Request $request, $collection_name)
    {
        $getMediaCollectionName = Media::get_media_collection_name($collection_name);

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->collection($getMediaCollectionName, $transformer);
    }

    public function getAllMediaCollectionById(Request $request, $model_id, $collection_name)
    {
        $getAllMediaCollectionById = Media::get_all_media_in_collection_by_id($model_id, $collection_name);

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->collection($getAllMediaCollectionById, $transformer);
    }

    public function getAllMediaCollectionByType(Request $request, $model_type, $collection_name)
    {
        $getAllMediaCollectionByType = Media::get_all_media_in_collection_by_type($model_type, $collection_name);

        if ($request->has('includes')) {
            $transformer = new $this->transformer($request->get('includes'));
        } else {
            $transformer = new $this->transformer();
        }

        return $this->response->collection($getAllMediaCollectionByType, $transformer);
    }
}
