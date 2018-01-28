<?php

use Illuminate\Database\Seeder;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Dish::class, 15)->create([
            'restaurant_id' => 1,
            'category' => 'Any category'
        ]);
    }
}
