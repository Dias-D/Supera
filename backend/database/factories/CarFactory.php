<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $brand = ['Ferrari', 'Fiat', 'Tesla'];
        $model = ['Sedan', 'Sport', 'Mini'];

        return [
            'user_id'   => User::first()->id,
            'name'      => $this->faker->country,
            'brand'     => $this->faker->randomElement($brand),
            'model'     => $this->faker->randomElement($model),
            'version'   => $this->faker->numberBetween(0, 5)
        ];
    }
}
