<?php

namespace Database\Factories;

use App\Events\Number\Created;
use App\Models\Customer;
use App\Models\Number;
use App\Repositories\StatusRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = (new StatusRepository())->filter('allow_numbers')->toArray();

        return [
            'customer_id' => function () {
                return Customer::factory()->create();
            },
            'status_id'   => function () use ($status) {
                $element = $this->faker->randomElement($status);
                return $element['id'];
            },
            'number'      => $this->faker->numerify(\config('custom.mask')),
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (Number $number) {
            \event(new Created($number->getKey()));
        });
    }
}
