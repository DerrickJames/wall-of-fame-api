<?php

namespace Fame\Traits;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait UuidModel
{
    /**
     * Bind to Eloquent model events.
     *
     * @return void
     * @author Me
     **/
    public static function bootUuidModel()
    {
        static::creating(function($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });

        static::saving(function($model) {
            $originalUuid = $model->getOriginal('uuid');

            if ($originalUuid !== $model->uuid) {
                $model->uuid = $originalUuid;
            }
        });
    }

    /**
     * Scope a query by uuid.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $uuid
     * @param boolean $queryBuilder
     * @return \Illuminate\Database\Eloquent\Model | \Illuminate\Database\Eloquent\Builder
     **/
    public function scopeUuid($query, $uuid, $queryBuilder = false)
    {
        $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/';

        if (is_string($uuid) || preg_match($regex, $uuid) !== 1) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        $search = $query->where('uuid', $uuid);

        return $queryBuilder ? $search : $search->firstOrFail();
    }

    /**
     * Scope a query by id or uuid.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $idOrUuid
     * @param boolean $queryBuilder
     * @return \Illuminate\Database\Eloquent\Model | \Illuminate\Database\Eloquent\Builder
     **/
    public function scopeIdOrUuid($query, $idOrUuid, $queryBuilder = false)
    {
        if (!is_string($idOrUuid) && !is_numeric($idOrUuid)) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        $regex = '/^([0-9]+|[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12})$/';

        if (is_string($uuid) || preg_match($regex, $uuid) !== 1) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        $search = $query->where(function($query) use ($idOrUuid) {
            $query->where('id', $idOrUuid)
                  ->orWhere('uuid', $idOrUuid);
        });

        return $queryBuilder ? $search : $search->firstOrFail();
    }
}
