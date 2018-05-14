<?php

namespace Tests\Unit;

use App\Exceptions\TaskAlreadyDoneException;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDoneMarksTaskAsDoneInDatabase()
    {
        // setup
        $task = factory(Task::class)->create([]);

        $this->assertEmpty($task->done_at);
        $this->assertDatabaseHas('tasks', ['done_at' => null]);

        // execution
        $task->done();

        // assertion
        $this->assertNotEmpty($task->done_at);
        $this->assertDatabaseMissing('tasks', [
            'done_at' => null
        ]);
    }

    public function testDoneDoesntOverwritePreviouslyDoneTask()
    {
        $this->expectException(TaskAlreadyDoneException::class);

        $task = factory(Task::class)->states(['done'])->create([]);

        $this->assertNotEmpty($task->done_at);
        $this->assertDatabaseMissing('tasks', ['done_at' => null]);

        $oldDoneAt = $task->done_at;

        $task->done();

        $newDoneAt = $task->done_at;

        $this->assertEquals($oldDoneAt, $newDoneAt);
    }
}
