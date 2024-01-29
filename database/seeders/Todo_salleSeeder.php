<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Todo_salleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo_salles')->insert([
            [
                'salle_id' => 10,
                'todo_id' => 4
            ],
            [
                'salle_id' => 10,
                'todo_id' => 6
            ],
            [
                'salle_id' => 10,
                'todo_id' => 3
            ],
            [
                'salle_id' => 10,
                'todo_id' => 9
            ],
            [
                'salle_id' => 5,
                'todo_id' => 4
            ],
            [
                'salle_id' => 5,
                'todo_id' => 7
            ],
            [
                'salle_id' => 1,
                'todo_id' => 4
            ],
            [
                'salle_id' => 3,
                'todo_id' => 6
            ]

        ]);
    }
}
