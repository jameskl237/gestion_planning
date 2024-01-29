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
            ],

            [
                'nom' => 'CDBC',
                'libelle' => 'Chef du departement de Biochimie',
                'rang' => 2
            ],

            [
                'nom' => 'CDBPA',
                'libelle' => 'Chef du departement de Biologie et physiologie animales',
                'rang' => 2
            ],

            [
                'nom' => 'CDBPV',
                'libelle' => 'Chef du departement de Biologie et physiologie vegetales',
                'rang' => 2
            ],

            [
                'nom' => 'CDMIB',
                'libelle' => 'Chef du departement de Microbiologie',
                'rang' => 2
            ],

            [
                'nom' => 'CDST',
                'libelle' => 'Chef du departement de Science de la terre',
                'rang' => 2
            ],

            [
                'nom' => 'CDCO',
                'libelle' => 'Chef du departement de Chimie Organique',
                'rang' => 2
            ],

            [
                'nom' => 'CDCI',
                'libelle' => 'Chef du departement de Chimie inorganique',
                'rang' => 2
            ],

            [
                'nom' => 'CDPH',
                'libelle' => 'Chef du departement de Physique',
                'rang' => 2
            ],

            [
                'nom' => 'CDMA',
                'libelle' => 'Chef du departement de Mathematiques',
                'rang' => 2
            ],

            [
                'nom' => 'CDIN',
                'libelle' => 'Chef du departement de Informatique',
                'rang' => 2
            ],

            [
                'nom' => 'SD',
                'libelle' => 'Secretaire du decanat',
                'rang' => 3
            ],

            [
                'nom' => 'GSSE',
                'libelle' => 'Gerant du service des stages et de l\'emploi',
                'rang' => 3
            ],

            [
                'nom' => 'GSF',
                'libelle' => 'Gerant du service de la formation',
                'rang' => 3
            ],

            [
                'nom' => 'GSAGP',
                'libelle' => 'Gerant du service des Affaires Générales et de la Planification',
                'rang' => 2
            ],

            [
                'nom' => 'GSMM',
                'libelle' => 'Gerant du service de la Mobilité et des Missions',
                'rang' => 3
            ],

            [
                'nom' => 'GBAIO',
                'libelle' => 'Gerant du Bureau d\'Appui à l\'Insertion et à l\'Orientation ',
                'rang' => 4
            ],

            [
                'nom' => 'GBITS',
                'libelle' => 'Gerant du Bureau des Technologies de l\'Information et des Systèmes ',
                'rang' => 4
            ],

            [
                'nom' => 'GBUDG',
                'libelle' => 'Gerant du Bureau du Budget ',
                'rang' => 4
            ],

            [
                'nom' => 'GBCRCM',
                'libelle' => 'Gerant du Bureau de la Coopération, des Relations Extérieures et de la Communication',
                'rang' => 4
            ],

            [
                'nom' => 'GBPE',
                'libelle' => 'Gerant du Bureau de la Pédagogie et de l\'Enseignement ',
                'rang' => 4
            ],

            [
                'nom' => 'GBPN',
                'libelle' => 'Gerant du Bureau de la Planification et de la Normalisation ',
                'rang' => 4
            ],

            [
                'nom' => 'GBACAEPS',
                'libelle' => 'Gerant du Bureau d\'Assistance et de Contrôle des Activités des Enseignants et des Personnels de Soutien',
                'rang' => 4
            ],

            [
                'nom' => 'GBCOURRIER',
                'libelle' => 'Gerant du Bureau du Courrier ',
                'rang' => 3
            ],

            [
                'nom' => 'GBTRADUCTION',
                'libelle' => 'Gerant du Bureau de la Traduction ',
                'rang' => 3
            ],

            [
                'nom' => 'GARCHIVES',
                'libelle' => 'Gerant du Service des Archives ',
                'rang' => 3
            ],

            [
                'nom' => 'GSPPE',
                'libelle' => 'Gerant du Service de la Pédagogie, de la Planification et des Examens',
                'rang' => 2
            ],


        ]);
    }
}
