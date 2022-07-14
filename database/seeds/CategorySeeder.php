<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
            'id'            =>  1,
            'category'      =>  "مواد البناء",
            'created_by'      =>  "admin",
        ]);
        Category::create([
            'id'            =>  2,
            'category'      =>  "مواد غذائية",
            'created_by'      =>  "admin",
        ]);
    }
}
