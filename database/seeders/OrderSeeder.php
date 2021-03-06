<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory(10)->create();
        foreach (Order::all() as $order) {
            $products = Product::inRandomOrder()->take(rand(1, 5))->pluck('price', 'id');
            $total = 0;
            foreach ($products as $productId => $price) {
                $qty = rand(1, 5);
                $order->products()->attach($productId, ['price' => $price, 'qty' => $qty]);
                $total += ($price * $qty);
            }
            $order->total = $total;
            $order->save();
        }
    }
}
