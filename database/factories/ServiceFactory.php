<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_name' => fake() -> word(2),
            'description' => fake() -> sentence(1),
            'price' => fake() -> numberBetween(200,500),
            'img_url'=> null,
        ];
    }
}
