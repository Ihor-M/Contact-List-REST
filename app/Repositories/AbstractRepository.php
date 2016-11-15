<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
abstract class AbstractRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $this->model = app()->make($this->model());
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes = [])
    {
        $myData = $this->model->findOrFail($id);

        return $myData->update($attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 20)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * @return mixed
     */
    abstract protected function model();

}