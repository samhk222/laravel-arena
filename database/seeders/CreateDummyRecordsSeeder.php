<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Number;
use Illuminate\Database\Seeder;

class CreateDummyRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()
            ->has(Number::factory()->count(rand(1, 10)))
            ->count(300)
            ->create();
    }
}
