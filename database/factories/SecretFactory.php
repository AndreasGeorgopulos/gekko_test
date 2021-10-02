<?php

namespace Database\Factories;

use App\Models\Secret;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SecretFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Secret::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hash' => sha1(Str::random(10) . Carbon::now()->format('Y-m-d H:i:s')),
            'secretText' => $this->faker->text(),
            'expiresAt' => Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s'),
            'remainingViews' => random_int(1, 10),
        ];
    }
}
