<?php

namespace Domain\Numbers\Actions;

use DB;

class GetNumbersByStatus
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __invoke(): \Illuminate\Support\Collection
    {
        return DB::table('numbers', 'numbers')
            ->select('status_id', 'st.color', 'st.description', DB::raw('count(*) as total'))
            ->leftJoin('statuses as st', 'st.id', '=', 'numbers.status_id')
            ->groupBy(['status_id', 'description', 'st.color'])->get();
    }
}
