<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plannings')->insert([
            [
                'name' => 'ICT',
                'description' => 'programme cc semestre 1',
                'user_id' => 5
            ],

            [
                'name' => 'ICT',
                'description' => 'programme des cours semestre 1',
                'user_id' => 5
            ],

            [
                'name' => 'ICT',
                'description' => 'programme des cours semestre 2',
                'user_id' => 2
            ],

            [
                'name' => 'ICT',
                'description' => 'programme sn semestre 1',
                'user_id' => 2
            ],

            [
                'name' => 'ICT',
                'description' => 'programme sn semestre 2',
                'user_id' => 3
            ],

            [
                'name' => 'ICT',
                'description' => 'programme cc semestre 2',
                'user_id' => 3
            ],

            [
                'name' => 'ICT',
                'description' => 'Reunion professeurs',
                'user_id' => 2
            ],

            [
                'name' => 'ICT',
                'description' => 'programme Travaux diriges semestre 1',
                'user_id' => 2
            ],

            [
                'name' => 'ICT',
                'description' => 'programme Travaux diriges semestre 2',
                'user_id' => 5
            ],

            [
                'name' => 'Informatique',
                'description' => 'programme Travaux diriges semestre 1',
                'user_id' => 2
            ],

        ]);
    }
}
