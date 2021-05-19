<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::create([
            'product_name' => 'Denny Romes',
            'slug' => 'dennyromes',
            'details' => 'This product os good',
            'product_pirce' => 5000,
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-1.jpg',
            'featured'=>1
        ])->categories()->attach(1);

        Product::create([
            'product_name' => 'Rhone Romes',
            'slug' => 'rhoneromes',
            'details' => 'This product os good Dhrangdhra ',
            'product_pirce' => 500,
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-2.jpg',
            'featured'=>1
        ])->categories()->attach(1);


        $product = Product::find(1);
        $product->categories()->attach(2);

        Product::create([
            'product_name' => 'Dhrangdhra Romes',
            'slug' => 'dhrangdhraromes',
            'details' => 'This product os good Rajkot',
            'product_pirce' => 5000,
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-3.jpg',
            'featured'=>1
        ])->categories()->attach(2);
        Product::create([
            'product_name' => 'DRomes',
            'slug' => 'dromes',
            'details' => 'This product os good facade',
            'product_pirce' => 5000,
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-4.jpg',
        ])->categories()->attach(2);
        Product::create([
            'product_name' => 'DAR T-shirt',
            'slug' => 'dartshirt',
            'details' => 'This product os good Rajkot',
            'product_pirce' => 5000,
            'image' => 'product-5.jpg',
            'product_description' => 'This product is good and nice infromation provider and nice t handle',

        ])->categories()->attach(3);
        Product::create([
            'product_name' => 'Unibon T-shirt',
            'slug' => 'unibontshirt',
            'details' => 'This product os good Rajkot',
            'product_pirce' => 5000,
            'image' => 'product-6.jpg',
            'product_description' => 'This product is good and nice infromation provider and nice t handle',

        ])->categories()->attach(3);;
        Product::create([
            'product_name' => 'Romin Romes',
            'slug' => 'rominromes',
            'details' => 'This product os good Rajkot',
            'product_pirce' => 5000,
            'image' => 'product-7.jpg',
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-1.jpg',
            'featured'=>0
        ])->categories()->attach(4);
        Product::create([
            'product_name' => 'Piyush Romes',
            'slug' => 'piyushromes',
            'details' => 'This product os good Rajkot',
            'product_pirce' => 450,
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-8.jpg',
        ])->categories()->attach(4);
        Product::create([
            'product_name' => 'Nish Romes',
            'slug' => 'nishromes',
            'details' => 'This product os good Rajkot',
            'product_pirce' => 45,
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-2.jpg',
            'featured'=>1
        ])->categories()->attach(5);
        Product::create([
            'product_name' => 'Raj Romes',
            'slug' => 'rajromes',
            'details' => 'This product os good Rajkot',
            'product_pirce' => 5000,
            'product_description' => 'This product is good and nice infromation provider and nice t handle',
            'image' => 'product-6.jpg',
            'featured'=>1
        ])->categories()->attach(5);
    }
}
