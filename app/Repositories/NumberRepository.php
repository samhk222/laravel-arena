<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;

class NumberRepository extends Repository
{

    public function filter(array $filter)
    {
        $filter = collect($filter);

        $items = $this->with(['customer', 'status'])->newQuery();

        $items->when($filter->has('customer_id'), function (Builder $builder) use ($filter) {
            $builder->where('customer_id', $filter->get('customer_id'));
        });

        $items->when($filter->has('term'), function (Builder $builder) use ($filter) {
            $builder->where('number', 'like', "%" . $filter->get('term') . "%");
            $builder->orWhereHas('customer', function (Builder $builder) use ($filter) {
                $builder->where('name', 'like', '%' . $filter->get('term') . '%');
            });
        });

        return $items->paginate(20, '*', '', $filter->get('page') ?? 1);
    }
}
