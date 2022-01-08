<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $admin_user;
    protected $regular_user;

    protected function setUp(): void
    {
        parent::setUp();;
        $this->defineAdminUser();
        $this->defineRegularUser();
    }


    public function defineAdminUser()
    {
        $this->admin_user = User::where('type', 'admin')->first();

        if (!$this->admin_user) {
            $this->admin_user = User::factory()->admin()->make();
        }
    }

    private function defineRegularUser()
    {
        $this->regular_user = User::where('type', 'user')->first();

        if (!$this->regular_user) {
            $this->regular_user = User::factory()->regular()->create();
        }
    }

}
