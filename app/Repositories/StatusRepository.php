<?php


namespace App\Repositories;


use App\Models\Customer;
use Exception;

class StatusRepository extends Repository
{
    public function getIdByDescription(string $description)
    {
        $item = $this->newQuery()->where(['description' => $description])->first();

        if (!$item) {
            throw new Exception("There's no status with the provided description");
        }

        return $item->getKey();
    }

    /**
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function filter(string $type)
    {
        return $this->newQuery()->where($type, 1)->get();
    }
}
