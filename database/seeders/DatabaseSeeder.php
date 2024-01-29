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
        $this->call(SalleSeeder::class);


        \App\Models\User::factory(20)->has(
            Todo::factory(3)
        )->create();

        $this->call(PlanningSeeder::class);
        $this->call(Todo_userSeeder::class);
        $this->call(Todo_planningSeeder::class);
        $this->call(Todo_salleSeeder::class);
    }
}
