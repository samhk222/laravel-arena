<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;

class CustomerRepository extends Repository
{

    public function filter(array $filter)
    {
        $filter = collect($filter);

        $items = $this->newQuery();

        $items->when($filter->has('term'), function (Builder $builder) use ($filter) {
            $builder->where('name', 'like', "%" . $filter->get('term') . "%");
            $builder->orWhere('document', 'like', "%" . $filter->get('term') . "%");
            $builder->orWhereHas('status', function (Builder $builder) use ($filter) {
                $builder->where('description', 'like', '%' . $filter->get('term') . '%');
            });
            $builder->orWhereHas('numbers', function (Builder $builder) use ($filter) {
                $builder->where('number', 'like', '%' . $filter->get('term') . '%');
            });
        });

        return $items->paginate(20, '*', '', $filter->get('page') ?? 1);
    }
}
