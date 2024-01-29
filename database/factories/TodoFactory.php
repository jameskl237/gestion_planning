<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'date_debut'=> $this->faker->date(),
            'date_fin' => $this->faker->date(),
            'heure_debut' => $this->faker->time(),
            'heure_fin' => $this->faker->time(),
            'jour' => ''
        ];
    }
}
