<?php

namespace Database\Seeders;

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class AddUsersSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defineData() as $user) {
            (new UserRepository())->create($user);
        }
    }

    private function defineData(): array
    {
        return [
            [
                'email'    => 'admin@admin.com',
                'name'     => 'Admin',
                'type'     => 'admin',
                'password' => \bcrypt('asdasd'),
            ],
            [
                'email'    => 'user@user.com',
                'name'     => 'User',
                'type'     => 'user',
                'password' => \bcrypt('asdasd'),
            ],
        ];
    }
}
