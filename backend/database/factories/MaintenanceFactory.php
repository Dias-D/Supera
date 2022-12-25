<?php

namespace Database\Factories;

use App\Const\Maintenance;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $carsId = Car::all()->pluck('id')->toArray();
        $types = [
            'Freios', 'Motor', 'Câmbio'
        ];

        return [
            'car_id'        => $this->faker->randomElement($carsId),
            'type'          => $this->faker->randomElement($types),
            'description'   => 'Realizando manutenção de veículo',
            'start_date'    => '2022-12-' . $this->faker->numberBetween(01, 25),
            'end_date'      => now(),
        ];
    }
}
