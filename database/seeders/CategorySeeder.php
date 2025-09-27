<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Clothing', 'description' => 'Fashion and apparel'],
            ['name' => 'Home & Garden', 'description' => 'Home improvement and garden supplies'],
            ['name' => 'Sports & Outdoors', 'description' => 'Sports equipment and outdoor gear'],
            ['name' => 'Books', 'description' => 'Books and educational materials'],
            ['name' => 'Health & Beauty', 'description' => 'Health and beauty products'],
            ['name' => 'Toys & Games', 'description' => 'Toys and gaming products'],
            ['name' => 'Automotive', 'description' => 'Car parts and automotive accessories'],
            ['name' => 'Food & Beverages', 'description' => 'Food items and beverages'],
            ['name' => 'Office Supplies', 'description' => 'Office and business supplies'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                ['shop_id' => 1]
                // ['description' => $category['description']]
            );
        }

        $this->command->info('Categories seeded successfully!');
    }
}
