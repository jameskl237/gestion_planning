<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salles')->insert([
            ['name' => 'S003' ],
            ['name' => 'S005'],
            ['name' => 'S006'],
            ['name' => 'S008' ],
            ['name' => 'S111' ],
            ['name' => 'Amphi 1001'],
            ['name' => 'Amphi 350'],
            ['name' => 'Amphi 250'],
            ['name' => 'Amphi 502'],
            ['name' => 'Amphi 1002'],
            ['name' =>'Amphi 1003'],
            ['name' =>'Amphi 2'],
            ['name' =>'R101'],
            ['name' =>'R103'],
            ['name' =>'R110'],
            ['name' =>'Biblioteque departement d\'informatique'],
        ]);
    }
}
