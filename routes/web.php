<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'tasks'], function() {
    Route::get('/', ['uses' => 'TaskController@index']);
    Route::get('/{task}', ['uses' => 'TaskController@single']);

    Route::put('/{task}', ['uses' => 'TaskController@update']);
    Route::put('/{task}/done', ['uses' => 'TaskController@markAsDone']);

    Route::post('/', ['uses' => 'TaskController@create']);

    Route::delete('/{task}', ['uses' => 'TaskController@delete']);
});
