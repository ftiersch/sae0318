<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        // with = eager loading
        $tasks = Task::with('tags')->get();

        return response()->json($tasks);
    }

    public function single(Task $task) {
        return response()->json($task);
    }

    public function update(Request $request, Task $task) {
        $task->updateFromArray($request->all());

        $task->load('tags');

        /* Andere Möglichkeit
        $task->update($request->all());
        */

        return response()->json($task);
    }

    public function create(Request $request) {
        $task = Task::createFromArray($request->all());

        $task->load('tags');

        /* Andere Möglichkeit
        Task::create($request->all());
        */

        return response()->json($task);
    }

    public function delete(Task $task) {
        $task->delete();

        return response()->json($task);
    }

    public function markAsDone(Task $task) {
        $task->done();

        return response()->json($task);
    }
}
