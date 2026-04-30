<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        $phones = [];
        for ($i = 0, $n = fake()->numberBetween(1, 3); $i < $n; $i++) {
            $phones[] = fake()->numerify('+1##########');
        }

        return [
            'name' => fake()->name(),
            'phone' => $phones,
            'address' => fake()->address(),
        ];
    }
}
