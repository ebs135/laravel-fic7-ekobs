<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $users = User::all();

    return [
      'number' => fake()->randomNumber(8),
      'total_price' => fake()->numberBetween(150000, 500000),
      'payment_status' => 'pending',
      'user_id' => $users->random()->id,
      'seller_id' => $users->random()->id,
    ];
  }
}
