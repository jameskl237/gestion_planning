<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Todo_planningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo_plannings')->insert([
            [
                'planning_id' => 10,
                'todo_id' => 4
            ],
            [
                'planning_id' => 10,
                'todo_id' => 6
            ],
            [
                'planning_id' => 10,
                'todo_id' => 3
            ],
            [
                'planning_id' => 10,
                'todo_id' => 9
            ],
            [
                'planning_id' => 5,
                'todo_id' => 4
            ],
            [
                'planning_id' => 5,
                'todo_id' => 7
            ],
            [
                'planning_id' => 1,
                'todo_id' => 4
            ],
            [
                'planning_id' => 3,
                'todo_id' => 6
            ]

        ]);
    }
}
