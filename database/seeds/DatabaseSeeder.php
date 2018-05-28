<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Hugo',
            'email' => 'admin@todo.de',
            'password' => \Illuminate\Support\Facades\Hash::make('test'),
        ]);
    }
}
