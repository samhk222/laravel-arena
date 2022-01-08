<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_logged_in_user_can_see_dashboard()
    {
        $response = $this->actingAs($this->admin_user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Registered Numbers', "User can't see the counter on dashboard");
    }
}
