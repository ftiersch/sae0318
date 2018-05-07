<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->timestamps();
        });

        Schema::create('tasks_tags', function (Blueprint $table) {
             $table->integer('task_id')->unsigned();
             $table->integer('tag_id')->unsigned();

             $table->timestamps();

             $table->primary(['task_id', 'tag_id']);

             $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
             $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks_tags');
        Schema::dropIfExists('tags');
    }
}
