<?php

namespace Database\Seeders;

use App\Repositories\StatusRepository;
use Illuminate\Database\Seeder;

class CreateStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defineData() as $key => $status) {
            (new StatusRepository())->create($status);
        }
    }

    /**
     * @return array
     */
    private function defineData(): array
    {
        return [
            ['description' => 'New', 'color' => 'primary', 'allow_customers' => 1, 'allow_numbers' => 0],
            ['description' => 'Active', 'color' => 'success', 'allow_customers' => 1, 'allow_numbers' => 1],
            ['description' => 'Inactive', 'color' => 'info', 'allow_customers' => 0, 'allow_numbers' => 1],
            ['description' => 'Suspended', 'color' => 'warning', 'allow_customers' => 1, 'allow_numbers' => 0],
            ['description' => 'Cancelled', 'color' => 'danger', 'allow_customers' => 1, 'allow_numbers' => 1],
        ];
    }
}
