<?php

use App\Typesaisie;
use Illuminate\Database\Seeder;

class TypesaisieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typesaisie::truncate();
        Typesaisie::create([
            'id' => 1,
            'libelle' => "الحجز الاعتباري",
            'created_by'   =>  "admin",
        ]);
        Typesaisie::create([
            'id' => 2,
            'libelle' => "الحجز التحفظي",
            'created_by'   =>  "admin",
        ]);
    }
}
