<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    public function testAuth()
    {

        $this->post('/api/register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => '11111111',
            'password_confirmation' => '11111111'
        ])->assertStatus(200);

        $this->post('/api/login', [
            'email' => 'foo@example.com',
            'password' => '11111111',
        ])->assertStatus(200);

    }
}
