<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Product::create([
            'libelle'   =>  "اسمنت",
            'category_id'   =>  1,
            'created_by'   =>  "admin",
        ]);
        Product::create([
            'libelle'   =>  "سكر",
            'category_id'   =>  2,
            'created_by'   =>  "admin",
        ]);

    }
}
