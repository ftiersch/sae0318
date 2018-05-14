<?php

namespace Tests\Feature;

use App\Exceptions\TaskAlreadyDoneException;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testTasksAreAllReturned()
    {
        // setup
        $tasks = factory(Task::class, 3)->create([]);

        // execution
        $response = $this->json('GET', route('tasks.list'));

        // assertion
        $response   ->assertJsonCount(3)
                    ->assertJsonStructure(['*' => ['id', 'task', 'done_at']]);
    }
}
