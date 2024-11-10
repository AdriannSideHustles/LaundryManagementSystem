<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        // \App\Models\Service::factory(10)->create();
        \App\Models\User::factory(1)->create();
        // \App\Models\Equipment::factory(10)->create();
        // \App\Models\EquipmentMonitoring::factory(10)->create();
        // \App\Models\Booking::factory(10)->create();
        // \App\Models\Billing::factory(10)->create();
        // \App\Models\Payment::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
