<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'customer_user_id' => 1,
        'staff_user_id' => 1,
        'service_id' => 1,
        'transaction_status' => 1,
        'booking_date' => fake()->dateTimeBetween($startdate='-2 months', $enddate= 'now'),
        'booking_schedule'=> fake()->dateTimeBetween($startdate='-2 months', $enddate= 'now'),
        'pickup_schedule'=> fake()->dateTimeBetween($startdate='-2 months', $enddate= 'now')
        ];
    }
}
