<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['task'];

    protected $dates = ['done_at'];

    public function updateFromArray($data) {
        $this->task = $data['task'];
        $this->save();

        return $this;
    }

    public static function createFromArray($data) {
        $task = new Task();
        $task->task = $data['task'];
        $task->save();

        return $task;
    }

    public function done() {
        $this->done_at = now();
        $this->save();
    }
}
