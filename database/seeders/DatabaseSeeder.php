<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Location::create([
            'location_name' => 'BSD',
        ]);
        \App\Models\Location::create([
            'location_name' => 'FPOne',
        ]);
        \App\Models\Location::create([
            'location_name' => 'Bogor',
        ]);

        \App\Models\User::create([
            'name' => 'Anton',
            'email' => 'kokonacci@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Anton888'),
            'kode_agent' => '123',
            'level' => 'AD',
            'location_id' => 1,
            'role' => 2,

        ]);
        \App\Models\User::factory(30)->create();
    }
}
