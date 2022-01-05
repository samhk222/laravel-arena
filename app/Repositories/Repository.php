<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Repository
{
    /**
     * @var Model|string
     */
    private $model;

    /**
     * @var string|array
     */
    public $with;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = $this->model();
    }

    /**
     * @return Model
     */
    public function model(): string
    {
        $thisClassName  = Arr::last(explode('\\', get_class($this)));
        $modelClassName = str_replace('Repository', '', $thisClassName);

        return '\\App\\Models\\' . $modelClassName;
    }

    /**
     * @param array|string $with
     * @return $this
     */
    public function with($with)
    {
        $this->with = $with;

        return $this;
    }

    /**
     * @return Builder
     */
    public function newQuery()
    {
        $query = $this->model::query();

        if ($this->with) {
            $query->with($this->with);
        }

        return $query;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function exists(array $data)
    {
        return $this->newQuery()
            ->where($data)
            ->exists();
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function create(array $data)
    {
        return $this->newQuery()->create($data);
    }

    /**
     * @param array $data
     * @param array $attributes
     * @return Builder|Model
     */
    public function firstOrCreate(array $data, array $attributes = [])
    {
        return $this->newQuery()->firstOrCreate($data, $attributes);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function update(int $id, array $data)
    {
        $item = $this->find($id);

        $item->update($data);

        return $item->refresh();
    }

    /**
     * @param int $items
     * @param int $page
     * @param null $columns
     * @return LengthAwarePaginator
     */
    public function paginate($page = 1, $items = 20, $columns = null): LengthAwarePaginator
    {
        return $this
            ->newQuery()
            ->paginate($items, $columns ?? ['*'], 'page', $page);
    }

    /**
     * @param string $column
     * @param string $order
     * @return Builder
     */
    public function orderBy(string $column, $order = 'ASC')
    {
        return $this
            ->newQuery()
            ->orderBy($column, $order);
    }

    /** * @param int $id * @return \Illuminate\Database\Eloquent\Collection|Model|null */
    public function find(int $id)
    {
        return $this->newQuery()->find($id);
    }

    /**
     * @param string $email
     * @return Builder|Model|object|null
     */
    public function findByEmail(string $email)
    {
        return $this->newQuery()->where('email', $email)->first();
    }

    /** * @param string $sortField * @return Builder|Model|object|null */
    public function latest(string $sortField = 'created_at')
    {
        return $this->newQuery()->latest($sortField)->first();
    }

    /** * @param string $scheme * @return Builder|Model|object|null */
    public function findByScheme(string $scheme)
    {
        return $this->newQuery()
            ->where(compact('scheme'))
            ->first();
    }

    /**
     * @param string $scheme
     * @return Builder|Model|object|null
     */

    /**
     * @param string $orderBy
     * @param string $orderDir
     * @return Collection
     */
    public function all(string $orderBy = 'created_at', string $orderDir = 'asc'): Collection
    {
        return $this->newQuery()
            ->orderBy($orderBy, $orderDir)
            ->get();
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->newQuery()->get();
    }

    /**
     * @return Builder|Model|object|null
     */
    public function first()
    {
        return $this->newQuery()->first();
    }

    /**
     * @param array $attributes
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function where(array $attributes)
    {
        return $this->newQuery()
            ->where($attributes)
            ->get();
    }

    /**
     * @return int
     */
    public function latestId()
    {
        return $this->newQuery()->withTrashed()->max('id');
    }

    /**
     * @return int
     */
    public function nextId()
    {
        return $this->latestId() + 1;
    }
}
