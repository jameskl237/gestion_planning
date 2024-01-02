<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Todo_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo_users')->insert([
            [
                'user_id' => 10,
                'todo_id' => 4
            ],
            [
                'user_id' => 10,
                'todo_id' => 6
            ],
            [
                'user_id' => 10,
                'todo_id' => 3
            ],
            [
                'user_id' => 10,
                'todo_id' => 9
            ],
            [
                'user_id' => 5,
                'todo_id' => 4
            ],
            [
                'user_id' => 5,
                'todo_id' => 7
            ],
            [
                'user_id' => 1,
                'todo_id' => 4
            ],
            [
                'user_id' => 3,
                'todo_id' => 6
            ]

        ]);
    }
}
