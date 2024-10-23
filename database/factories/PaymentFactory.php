<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'billing_id' => 1,
        'payment_date' => fake()->dateTimeBetween($startdate='-2 months', $enddate= 'now'),
        'payment_method' => "Cash",
        'receipt_proof_imgUrl'=> fake()->imageUrl(),
        ];
    }
}
