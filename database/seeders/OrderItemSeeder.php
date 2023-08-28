<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $orders = Order::all();
    $products = Product::all();

    foreach ($orders as $order) {
      $n = rand(1, 5);
      for ($i = 0; $i < $n; $i++) {
        OrderItem::factory()->create([
          'order_id' => $order->id,
          'product_id' => $products->random()->id,
        ]);
      }
    }
  }
}
