<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\User;
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

    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 10, 1000),
            'provider' => fake()->word,
            'user_id' => User::query()->inRandomOrder()->first()->id,
        ];
    }
}
