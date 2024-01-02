<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'nom' => 'Doyen',
                'libelle' => '',
                'rang' => 1
            ],

            [
                'nom' => 'VDPSAA',
                'libelle' => 'Vice doyen de la division de la programmation et suivie des affaires academiques',
                'rang' => 2
            ],

            [
                'nom' => 'VDSSE',
                'libelle' => 'Vice doyen de la Division de la scolarité et suivi de l\'etudiant',
                'rang' => 2
            ],

            [
                'nom' => 'VDRC',
                'libelle' => 'Vice doyen de la division de la recherche et de la coopération',
                'rang' => 2
            ],

            [
                'nom' => 'CDAF',
                'libelle' => 'Vice doyen de la division des affaires administratives et financières',
                'rang' => 2
            ],

            [
                'nom' => 'CDSAARS',
                'libelle' => 'vice doyen de la division des affaires academiques de la recherche et de la scolarite',
                'rang' => 2
            ]
        ]);
    }
}
