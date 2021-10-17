<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Gadgets'],
            ['name' => 'Furniture'],
            ['name' => 'Make up'],
            ['name' => 'Vegetable'],
            ['name' => 'Tools'],
            ['name' => 'Rumah Tangga']
        ];

        DB::table('product_categories')->insert($data);
    }
}
