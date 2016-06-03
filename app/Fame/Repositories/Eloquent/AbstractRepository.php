<?php

namespace Fame\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * The model to execute queries on.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a new instance of the model.
     *
     * @param array $attributes
     * @return \Illuminate\Databse\Eloquent\Model
     */
    public function getInstance(array $attributes = [])
    {
        $this->model->newInstance($attributes);
    }
}
