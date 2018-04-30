<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();

        return response()->json($tasks);
    }

    public function single(Task $task) {
        return response()->json($task);
    }

    public function update(Request $request, Task $task) {
        $task->task = $request->input('task');
        $task->save();

        /* Andere Möglichkeit
        $task->update($request->all());
        */

        return response()->json($task);
    }

    public function create(Request $request) {
        $task = new Task();
        $task->task = $request->input('task');
        $task->save();

        /* Andere Möglichkeit
        Task::create($request->all());
        */

        return response()->json($task);
    }

    public function delete(Task $task) {
        $task->delete();

        return response()->json($task);
    }
}