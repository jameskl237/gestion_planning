<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departements')->insert([
            ['nom' => 'Biochimie' ],
            ['nom' => 'Biologie et physiologie animales'],
            ['nom' => 'Biologie et physiologie vegetales'],
            ['nom' => 'Chimie Inorganique' ],
            ['nom' => 'Chimie Organique' ],
            ['nom' => 'Informatique'],
            ['nom' => 'Mathematique'],
            ['nom' => 'Microbiologie'],
            ['nom' => 'Physique'],
            ['nom' => 'Science de la terre']
        ]);
    }
}
