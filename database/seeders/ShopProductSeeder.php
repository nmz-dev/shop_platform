<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;

class ShopProductSeeder extends Seeder
{
    public function run()
    {
        // Get existing shops
        $shops = Shop::all();

        foreach ($shops as $shop) {
            // Create categories for each shop
            $categories = $this->createCategoriesForShop($shop);
            
            // Create products for each shop
            $this->createProductsForShop($shop, $categories);
        }
    }

    private function createCategoriesForShop($shop)
    {
        $categoryData = [];
        
        switch (strtolower($shop->name)) {
            case 'electronic':
                $categoryData = [
                    'Mobile Phones',
                    'Laptops',
                    'Headphones',
                    'Smart Watches',
                    'Tablets'
                ];
                break;
            case 'shopfinity':
                $categoryData = [
                    'Fashion',
                    'Home & Garden',
                    'Sports',
                    'Books',
                    'Toys'
                ];
                break;
            case 'swiftbuy':
                $categoryData = [
                    'Groceries',
                    'Personal Care',
                    'Health',
                    'Beverages',
                    'Snacks'
                ];
                break;
            case 'velocity auto hub':
                $categoryData = [
                    'Car Parts',
                    'Motorcycles',
                    'Accessories',
                    'Tools',
                    'Maintenance'
                ];
                break;
            default:
                $categoryData = [
                    'General',
                    'Popular',
                    'New Arrivals'
                ];
        }

        $categories = [];
        foreach ($categoryData as $categoryName) {
            $category = Category::create([
                'name' => $categoryName,
                'shop_id' => $shop->id
            ]);
            $categories[] = $category;
        }

        return $categories;
    }

    private function createProductsForShop($shop, $categories)
    {
        $productData = [];
        
        switch (strtolower($shop->name)) {
            case 'electronic':
                $productData = [
                    ['name' => 'iPhone 15 Pro', 'price' => 999.99, 'category' => 'Mobile Phones', 'description' => 'Latest iPhone with advanced camera system'],
                    ['name' => 'Samsung Galaxy S24', 'price' => 899.99, 'category' => 'Mobile Phones', 'description' => 'Flagship Android smartphone'],
                    ['name' => 'MacBook Pro M3', 'price' => 1999.99, 'category' => 'Laptops', 'description' => 'Professional laptop with M3 chip'],
                    ['name' => 'Dell XPS 13', 'price' => 1299.99, 'category' => 'Laptops', 'description' => 'Ultra-portable Windows laptop'],
                    ['name' => 'Sony WH-1000XM5', 'price' => 399.99, 'category' => 'Headphones', 'description' => 'Noise-canceling wireless headphones'],
                    ['name' => 'Apple Watch Series 9', 'price' => 399.99, 'category' => 'Smart Watches', 'description' => 'Advanced fitness and health tracking'],
                    ['name' => 'iPad Pro 12.9"', 'price' => 1099.99, 'category' => 'Tablets', 'description' => 'Professional tablet with M2 chip'],
                ];
                break;
            case 'shopfinity':
                $productData = [
                    ['name' => 'Designer Jacket', 'price' => 149.99, 'category' => 'Fashion', 'description' => 'Stylish winter jacket'],
                    ['name' => 'Running Shoes', 'price' => 89.99, 'category' => 'Fashion', 'description' => 'Comfortable athletic footwear'],
                    ['name' => 'Garden Tool Set', 'price' => 79.99, 'category' => 'Home & Garden', 'description' => 'Complete gardening toolkit'],
                    ['name' => 'Yoga Mat', 'price' => 29.99, 'category' => 'Sports', 'description' => 'Non-slip exercise mat'],
                    ['name' => 'Programming Book', 'price' => 49.99, 'category' => 'Books', 'description' => 'Learn modern web development'],
                    ['name' => 'Educational Toy', 'price' => 24.99, 'category' => 'Toys', 'description' => 'STEM learning toy for kids'],
                ];
                break;
            case 'swiftbuy':
                $productData = [
                    ['name' => 'Organic Apples', 'price' => 4.99, 'category' => 'Groceries', 'description' => 'Fresh organic apples (1kg)'],
                    ['name' => 'Whole Grain Bread', 'price' => 3.49, 'category' => 'Groceries', 'description' => 'Healthy whole grain bread'],
                    ['name' => 'Shampoo & Conditioner', 'price' => 12.99, 'category' => 'Personal Care', 'description' => 'Hair care combo pack'],
                    ['name' => 'Vitamin C Tablets', 'price' => 19.99, 'category' => 'Health', 'description' => 'Immune system support'],
                    ['name' => 'Green Tea', 'price' => 8.99, 'category' => 'Beverages', 'description' => 'Premium green tea bags'],
                    ['name' => 'Mixed Nuts', 'price' => 15.99, 'category' => 'Snacks', 'description' => 'Healthy snack mix'],
                ];
                break;
            case 'velocity auto hub':
                $productData = [
                    ['name' => 'Brake Pads Set', 'price' => 89.99, 'category' => 'Car Parts', 'description' => 'High-performance brake pads'],
                    ['name' => 'Engine Oil 5W-30', 'price' => 34.99, 'category' => 'Maintenance', 'description' => 'Premium synthetic motor oil'],
                    ['name' => 'LED Headlights', 'price' => 129.99, 'category' => 'Accessories', 'description' => 'Bright LED headlight kit'],
                    ['name' => 'Motorcycle Helmet', 'price' => 199.99, 'category' => 'Motorcycles', 'description' => 'DOT approved safety helmet'],
                    ['name' => 'Socket Wrench Set', 'price' => 79.99, 'category' => 'Tools', 'description' => 'Professional mechanic tools'],
                ];
                break;
        }

        foreach ($productData as $index => $product) {
            // Find the category
            $category = collect($categories)->firstWhere('name', $product['category']);
            
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'discount' => rand(0, 20), // Random discount 0-20%
                'stock' => rand(10, 100),
                'category_id' => $category ? $category->id : $categories[0]->id,
                'shop_id' => $shop->id,
                'status' => 'active',
                'is_featured' => $index < 2, // First 2 products are featured
                'pics' => json_encode(['product_pics/sample_' . ($index + 1) . '.jpg']),
                'types' => json_encode(['Standard', 'Premium']),
                'colors' => json_encode(['Black', 'White', 'Blue']),
            ]);
        }
    }
}
