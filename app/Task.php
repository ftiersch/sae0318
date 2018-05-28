<?php

namespace App;

use App\Exceptions\TaskAlreadyDoneException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = ['task'];

    protected $dates = ['done_at'];

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tasks_tags')->orderBy('name', 'ASC')->withTimestamps();
    }

    public function scopeNotDone($query) {
        $query->whereNull('done_at');
    }

    public function updateFromArray($data) {
        $this->task = $data['task'];
        $this->save();

        $this->updateTags($data['tags']);

        return $this;
    }

    public static function createFromArray($data) {
        $task = new Task();
        $task->task = $data['task'];
        $task->save();

        $task->updateTags($data['tags']);

        return $task;
    }

    public function updateTags($tags) {
        $tagIds = [];
        if (!empty($tags)) {
            foreach ($tags as $name) {
                $tag = Tag::findOrCreate($name);
                $tagIds[] = $tag->id;
            }
        }
        $this->tags()->sync($tagIds);
    }

    public function done() {
        if (!empty($this->done_at)) {
            throw new TaskAlreadyDoneException('Task ' . $this->id . ' is marked as done twice');
        }

        $this->done_at = now();
        $this->save();
    }
}
