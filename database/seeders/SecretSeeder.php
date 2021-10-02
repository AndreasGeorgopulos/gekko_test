<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SecretSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Secret::factory()->create();
        \App\Models\Secret::factory()->create([
            'expiresAt' => Carbon::now()->addMinutes(3)->format('Y-m-d H:i:s'),
            'remainingViews' => 3,
        ]);
        \App\Models\Secret::factory()->create([
            'expiresAt' => Carbon::now()->addMinutes(2)->format('Y-m-d H:i:s'),
            'remainingViews' => 4,
        ]);
    }
}
