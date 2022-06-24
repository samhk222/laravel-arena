<?php

namespace Domain\Customers\Actions;

use DB;

class GetCustomersByStatus
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __invoke(): \Illuminate\Support\Collection
    {
        return DB::table('customers', 'customers')
            ->select('status_id', 'st.description', DB::raw('count(*) as total'))
            ->leftJoin('statuses as st', 'st.id', '=', 'customers.status_id')
            ->groupBy(['status_id', 'description'])->pluck('total', 'description');
    }
}
