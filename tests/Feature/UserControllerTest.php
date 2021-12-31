<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_paginate_users()
    {
        User::factory()->count(10)->create();
        $response = $this->call('GET','api/users', ['pageSize' => 5, 'page' => 2]);

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('links')
                ->has('meta')
                ->has('data', 5, fn($json) => $json
                    ->whereType('id', 'integer')
                    ->whereType('name', 'string')
                    ->whereType('email', 'string')
                    ->whereType('email_verified_at', 'string')
                    ->whereType('created_at', 'string')
                    ->whereType('updated_at', 'string')
                )
                ->has('meta', fn($json) => $json
                    ->where('current_page', 2)->etc()
                )
            );
    }
}
