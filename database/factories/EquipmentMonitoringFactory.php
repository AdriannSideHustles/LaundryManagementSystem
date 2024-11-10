<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentMonitoring>
 */
class EquipmentMonitoringFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'staff_user_id' => 1,
            'equipment_id' => 1,
            'monitoring_date' => fake()->dateTimeBetween($startdate='-2 months', $enddate= 'now'),
            'equipment_status' => "Working",
        ];
    }
}
