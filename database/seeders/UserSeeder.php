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
                'role_id' => 5,
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
                'role_id' => 5,
                'departement_id' => 6
            ]
        ]);
    }
}
