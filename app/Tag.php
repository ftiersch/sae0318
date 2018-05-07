<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tasks() {
        return $this->belongsToMany(Task::class, 'tasks_tags')->withTimestamps();
    }

    public static function findOrCreate($name) {
        $tag = self::where('name', 'LIKE', $name)->first();

        if (!$tag) {
            $tag = new self();
            $tag->name = $name;
            $tag->save();
        }

        return $tag;
    }
}
