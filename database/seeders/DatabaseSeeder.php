<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\Todo_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(DepartementSeeder::class);

         \App\Models\User::factory(10)->has(
            Todo::factory(3)
         )->create();

        $this->call(Todo_userSeeder::class);

    }
}
