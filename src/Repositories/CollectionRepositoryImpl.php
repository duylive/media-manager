<?php

namespace VCComponent\Laravel\MediaManager\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\MediaManager\Entities\Collection;
use VCComponent\Laravel\MediaManager\Repositories\Contracts\CollectionRepository;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;

class CollectionRepositoryImpl extends BaseRepository implements CollectionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Collection::class;
    }

    public function getEntity()
    {
        return $this->model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findById($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundException('Collection');
        }

        return $item;
    }

    public function updateById($data, $id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundException('Collection');
        }

        return $this->update($data, $id);
    }

    public function deleteById($id)
    {
        $item = $this->model->find($id);

        if (!$item) {
            throw new NotFoundException('Collection');
        }

        $this->model->destroy($id);
    }
}
