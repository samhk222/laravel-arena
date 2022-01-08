<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    /**
     * @var string
     */
    private $route;
    private $customer;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->route    = \route('api.customers.store');
        $this->customer = Customer::factory()->defaultStatus()->make();
    }


    public function test_assert_that_an_unauthenticate_user_cant_create_customer()
    {
        $this->json('post', $this->route)
            ->assertStatus(401);
    }


    public function test_admin_cant_create_a_customer_with_empty_parameter()
    {
        $this
            ->actingAs($this->admin_user)
            ->json('post', $this->route)
            ->assertJsonStructure(['message', 'errors' => ['name', 'document']])
            ->assertStatus(422);
    }

    public function test_admin_cant_create_customer_without_name()
    {
        $payload = $this->customer->only('document');

        $this
            ->actingAs($this->admin_user)
            ->json('post', $this->route, $payload)
            ->assertJsonStructure(['message', 'errors' => ['name']])
            ->assertStatus(422);
    }

    public function test_admin_cant_create_customer_without_document()
    {
        $payload = $this->customer->only('name');

        $this
            ->actingAs($this->admin_user)
            ->json('post', $this->route, $payload)
            ->assertJsonStructure(['message', 'errors' => ['document']])
            ->assertStatus(422);
    }

    public function test_admin_can_create_an_normal_customer()
    {
        $payload = $this->customer->toArray();

        $this
            ->actingAs($this->admin_user)
            ->json('post', $this->route, $payload)
            ->assertJsonStructure(['data'])
            ->assertStatus(201);

        $this->assertDatabaseHas('customers', $payload);
    }

    public function test_created_customer_has_default_status()
    {
        $payload = $this->customer->toArray();

        $this
            ->actingAs($this->admin_user)
            ->json('post', $this->route, $payload)
            ->assertJsonFragment(['description' => Customer::NEW_STATUS])
            ->assertJsonPath('data.status.description', Customer::NEW_STATUS)
            ->assertJsonStructure(['data'])
            ->assertStatus(201);

        $this->assertDatabaseHas('customers', $payload);
    }

    public function test_regular_cant_create_a_customer_with_empty_parameter()
    {
        $this
            ->actingAs($this->regular_user)
            ->json('post', $this->route)
            ->assertJsonStructure(['message', 'errors' => ['name', 'document']])
            ->assertStatus(422);
    }

    public function test_regular_cant_create_customer_without_name()
    {
        $payload = $this->customer->only('document');

        $this
            ->actingAs($this->regular_user)
            ->json('post', $this->route, $payload)
            ->assertJsonStructure(['message', 'errors' => ['name']])
            ->assertStatus(422);
    }

    public function test_regular_cant_create_customer_without_document()
    {
        $payload = $this->customer->only('name');

        $this
            ->actingAs($this->regular_user)
            ->json('post', $this->route, $payload)
            ->assertJsonStructure(['message', 'errors' => ['document']])
            ->assertStatus(422);
    }

    public function test_regular_can_create_an_normal_customer()
    {
        $payload = $this->customer->toArray();

        $this
            ->actingAs($this->admin_user)
            ->json('post', $this->route, $payload)
            ->assertJsonStructure(['data'])
            ->assertStatus(201);

        $this->assertDatabaseHas('customers', $payload);
    }

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
