<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskControllerTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('DatabaseSeeder');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testTaskController()
    {

        $this->withoutExceptionHandling();

        $this->post('/api/login', [
            'email'    => 'foo@example.com',
            'password' => '11111111'
            ]);

        $this->get('/api/tasks')->assertStatus(200);

        $this->post('/api/tasks', [
                'title' => 'test',
                'status' => 0,
                'due' => now()
            ])->assertStatus(201);

        $this->get('/api/tasks/1')->assertStatus(200);

        $this->patch('/api/tasks/1', [
            'title' => 'test1',
            'status' => 2,
            'due' => now()
        ])->assertStatus(200);

        $this->delete('/api/tasks/1')->assertStatus(200);
    }
}
