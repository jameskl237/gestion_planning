<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'=> 'Messi',
                'email' => 'messi@gmail.com',
                'prenom' => 'Nguele',
                'password' => Hash::make('ayobo'),
                'image' => 'old.jpg',
                'telephone' => '636342510',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 35,
                'departement_id' => 6

            ],

            [
                'name'=> 'Nzekon',
                'email' => 'armel@gmail.com',
                'prenom' => 'Armel',
                'password' => Hash::make('ayobo'),
                'image' => 'old.jpg',
                'telephone' => '675645323',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 35,
                'departement_id' => 6

            ],

            [
                'name'=> 'Abessolo',
                'email' => 'abessolo@gmail.com',
                'prenom' => '',
                'password' => Hash::make('ayobo'),
                'image' => 'old.jpg',
                'telephone' => '675644323',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 35,
                'departement_id' => 6

            ],

            [
                'name'=> 'Aminou',
                'email' => 'aminou@gmail.com',
                'prenom' => '',
                'password' => Hash::make('ayobo'),
                'image' => 'etu.PNG',
                'telephone' => '636342510',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 2,
                'departement_id' => 6
            ],

            [
                'name'=> 'Nkouandou',
                'email' => 'Abou@gmail.com',
                'prenom' => 'Aboubakar',
                'password' => Hash::make('ayobo'),
                'image' => 'etu.PNG',
                'telephone' => '636342510',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 35,
                'departement_id' => 6
            ],

            [
                'name'=> 'NKOUOKAM',
                'email' => 'nkouokam@gmail.com',
                'prenom' => '',
                'password' => Hash::make('ayobo'),
                'image' => 'etu.PNG',
                'telephone' => '6363788787',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 35,
                'departement_id' => 6
            ],
            
            
            [
                'name'=> 'Mballa',
                'email' => 'mballa@gmail.com',
                'prenom' => 'suzanne',
                'password' => Hash::make('ayobo'),
                'image' => 'etu.PNG',
                'telephone' => '699637847',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 36,
                'departement_id' => 6
            ],

            [
                'name'=> 'Lontsi',
                'email' => 'lontsi@gmail.com',
                'prenom' => 'jule',
                'password' => Hash::make('ayobo'),
                'image' => 'etu.PNG',
                'telephone' => '6994578827',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 34,
                'departement_id' => 6
            ],

            [
                'name'=> 'Enoe',
                'email' => 'enoe@gmail.com',
                'prenom' => 'jean',
                'password' => Hash::make('ayobo'),
                'image' => 'etu.PNG',
                'telephone' => '677658790',
                'color' => 'dark dark-sidebar theme-cyan',
                'role_id' => 34,
                'departement_id' => 6
            ]
        ]);
    }
}
