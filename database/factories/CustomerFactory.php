<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use App\Repositories\StatusRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user   = User::first();
        $status = (new StatusRepository())->filter('allow_customers')->toArray();

        return [
            'user_id'   => $user->getKey(),
            'status_id' => function ($item) use ($status) {
                $element = $this->faker->randomElement($status);
                return $element['id'];
            },
            'name'      => $this->faker->name(),
            'document'  => $this->faker->numerify('########'),
        ];
    }

    public function defaultStatus()
    {
        return $this->state(function (array $attributes) {
            $status = (new StatusRepository())->where(['description' => Customer::NEW_STATUS])->first();
            return [
                'status_id' => $status->id,
            ];
        });
    }
}
